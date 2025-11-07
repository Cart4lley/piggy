<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $account = $user->account;
        
        if (!$account) {
            return redirect()->route('dashboard')->with('error', 'No account found.');
        }

        $categories = $this->getPaymentCategories();
        
        return view('payment.index', compact('user', 'account', 'categories'));
    }

    public function category($categorySlug)
    {
        $user = Auth::user();
        $account = $user->account;
        
        $categories = $this->getPaymentCategories();
        $category = collect($categories)->firstWhere('slug', $categorySlug);
        
        if (!$category) {
            return redirect()->route('payment.index')->with('error', 'Category not found.');
        }
        
        return view('payment.category', compact('user', 'account', 'category'));
    }

    public function company($categorySlug, $companySlug)
    {
        $user = Auth::user();
        $account = $user->account;
        
        $categories = $this->getPaymentCategories();
        $category = collect($categories)->firstWhere('slug', $categorySlug);
        
        if (!$category) {
            return redirect()->route('payment.index')->with('error', 'Category not found.');
        }
        
        $company = collect($category['companies'])->firstWhere('slug', $companySlug);
        
        if (!$company) {
            return redirect()->route('payment.category', $categorySlug)->with('error', 'Company not found.');
        }
        
        return view('payment.company', compact('user', 'account', 'category', 'company'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'category_slug' => 'required|string',
            'company_slug' => 'required|string', 
            'amount' => 'required|numeric|min:1',
            'account_number' => 'required|string',
            'customer_name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $account = $user->account;
        
        // Validate balance
        if ($account->balance < $request->amount) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient balance for this payment.'
            ]);
        }
        
        // Get company info
        $categories = $this->getPaymentCategories();
        $category = collect($categories)->firstWhere('slug', $request->category_slug);
        $company = collect($category['companies'])->firstWhere('slug', $request->company_slug);
        
        try {
            DB::beginTransaction();
            
            // Create payment transaction
            $transaction = Transaction::create([
                'account_id' => $account->id,
                'transaction_id' => Transaction::generateTransactionId(),
                'type' => 'payment',
                'amount' => $request->amount,
                'balance_before' => $account->balance,
                'balance_after' => $account->balance - $request->amount,
                'description' => "{$company['name']} Payment - {$request->customer_name}",
                'reference_number' => 'PAY' . rand(100000, 999999),
                'status' => 'completed',
                'metadata' => json_encode([
                    'category' => $category['name'],
                    'company' => $company['name'],
                    'account_number' => $request->account_number,
                    'customer_name' => $request->customer_name
                ])
            ]);
            
            // Update account balance
            $account->decrement('balance', $request->amount);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Payment successful!',
                'transaction' => $transaction,
                'new_balance' => $account->fresh()->balance
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            
            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Please try again.'
            ]);
        }
    }

    private function getPaymentCategories()
    {
        return [
            [
                'name' => 'Electronics & Technology',
                'slug' => 'electronics',
                'icon' => 'fas fa-laptop',
                'color' => '#3B82F6',
                'description' => 'Tech purchases, gadgets, and electronics',
                'companies' => [
                    [
                        'name' => 'Apple Store',
                        'slug' => 'apple',
                        'logo' => '🍎',
                        'description' => 'iPhone, iPad, Mac, and accessories',
                        'fields' => ['Apple ID', 'Product Code']
                    ],
                    [
                        'name' => 'Samsung Philippines',
                        'slug' => 'samsung',
                        'logo' => '📱',
                        'description' => 'Galaxy phones, tablets, and electronics',
                        'fields' => ['Samsung Account', 'Model Number']
                    ],
                    [
                        'name' => 'Xiaomi',
                        'slug' => 'xiaomi',
                        'logo' => '📲',
                        'description' => 'Smart devices and accessories',
                        'fields' => ['Mi Account', 'Device IMEI']
                    ],
                    [
                        'name' => 'Lazada Electronics',
                        'slug' => 'lazada-electronics',
                        'logo' => '🛒',
                        'description' => 'Online electronics marketplace',
                        'fields' => ['Order Number', 'Lazada Account']
                    ]
                ]
            ],
            [
                'name' => 'Entertainment & Media',
                'slug' => 'entertainment',
                'icon' => 'fas fa-play-circle',
                'color' => '#EF4444',
                'description' => 'Streaming, gaming, and entertainment services',
                'companies' => [
                    [
                        'name' => 'Netflix',
                        'slug' => 'netflix',
                        'logo' => '📺',
                        'description' => 'Streaming movies and TV shows',
                        'fields' => ['Email Address', 'Plan Type']
                    ],
                    [
                        'name' => 'Spotify',
                        'slug' => 'spotify',
                        'logo' => '🎵',
                        'description' => 'Music streaming service',
                        'fields' => ['Spotify Username', 'Subscription Type']
                    ],
                    [
                        'name' => 'Disney+ Hotstar',
                        'slug' => 'disney-plus',
                        'logo' => '🏰',
                        'description' => 'Disney movies and shows',
                        'fields' => ['Disney+ Email', 'Plan Duration']
                    ],
                    [
                        'name' => 'YouTube Premium',
                        'slug' => 'youtube-premium',
                        'logo' => '▶️',
                        'description' => 'Ad-free YouTube and YouTube Music',
                        'fields' => ['Google Account', 'Family Plan']
                    ],
                    [
                        'name' => 'Steam',
                        'slug' => 'steam',
                        'logo' => '🎮',
                        'description' => 'PC gaming platform',
                        'fields' => ['Steam ID', 'Game Title']
                    ]
                ]
            ],
            [
                'name' => 'Bills & Utilities',
                'slug' => 'utilities',
                'icon' => 'fas fa-bolt',
                'color' => '#F59E0B',
                'description' => 'Electricity, water, gas, and utility bills',
                'companies' => [
                    [
                        'name' => 'Meralco',
                        'slug' => 'meralco',
                        'logo' => '⚡',
                        'description' => 'Manila Electric Company',
                        'fields' => ['CAN Number', 'Service Period']
                    ],
                    [
                        'name' => 'Manila Water',
                        'slug' => 'manila-water',
                        'logo' => '💧',
                        'description' => 'Water utility services',
                        'fields' => ['Account Number', 'Billing Period']
                    ],
                    [
                        'name' => 'Maynilad Water',
                        'slug' => 'maynilad',
                        'logo' => '🚰',
                        'description' => 'West Zone water services',
                        'fields' => ['Customer Code', 'Due Date']
                    ],
                    [
                        'name' => 'NGCP',
                        'slug' => 'ngcp',
                        'logo' => '🏭',
                        'description' => 'National Grid Corporation',
                        'fields' => ['Facility ID', 'Transmission Fee']
                    ]
                ]
            ],
            [
                'name' => 'Telecommunications',
                'slug' => 'telecom',
                'icon' => 'fas fa-wifi',
                'color' => '#10B981',
                'description' => 'Internet, mobile, and communication services',
                'companies' => [
                    [
                        'name' => 'PLDT Home',
                        'slug' => 'pldt',
                        'logo' => '🏠',
                        'description' => 'Fiber internet and landline',
                        'fields' => ['Account Number', 'Plan Type']
                    ],
                    [
                        'name' => 'Globe Telecom',
                        'slug' => 'globe',
                        'logo' => '🌐',
                        'description' => 'Mobile and broadband services',
                        'fields' => ['Mobile Number', 'Plan Details']
                    ],
                    [
                        'name' => 'Smart Communications',
                        'slug' => 'smart',
                        'logo' => '📶',
                        'description' => 'Mobile network services',
                        'fields' => ['Smart Number', 'Load Amount']
                    ],
                    [
                        'name' => 'Sky Cable',
                        'slug' => 'sky-cable',
                        'logo' => '📡',
                        'description' => 'Cable TV and internet',
                        'fields' => ['Subscriber ID', 'Package Type']
                    ],
                    [
                        'name' => 'Converge ICT',
                        'slug' => 'converge',
                        'logo' => '🚀',
                        'description' => 'Fiber internet services',
                        'fields' => ['Account ID', 'Service Address']
                    ]
                ]
            ],
            [
                'name' => 'Online Services',
                'slug' => 'online-services',
                'icon' => 'fas fa-cloud',
                'color' => '#8B5CF6',
                'description' => 'Cloud services, software, and digital subscriptions',
                'companies' => [
                    [
                        'name' => 'Microsoft 365',
                        'slug' => 'microsoft-365',
                        'logo' => '💼',
                        'description' => 'Office suite and cloud storage',
                        'fields' => ['Microsoft Account', 'License Type']
                    ],
                    [
                        'name' => 'Google Workspace',
                        'slug' => 'google-workspace',
                        'logo' => '📧',
                        'description' => 'Business email and collaboration',
                        'fields' => ['Domain Name', 'User Count']
                    ],
                    [
                        'name' => 'Adobe Creative Cloud',
                        'slug' => 'adobe',
                        'logo' => '🎨',
                        'description' => 'Creative software suite',
                        'fields' => ['Adobe ID', 'Plan Type']
                    ],
                    [
                        'name' => 'Zoom',
                        'slug' => 'zoom',
                        'logo' => '📹',
                        'description' => 'Video conferencing service',
                        'fields' => ['Zoom Account', 'Meeting Plan']
                    ]
                ]
            ],
            [
                'name' => 'Food & Delivery',
                'slug' => 'food-delivery',
                'icon' => 'fas fa-utensils',
                'color' => '#F97316',
                'description' => 'Food delivery and restaurant payments',
                'companies' => [
                    [
                        'name' => 'GrabFood',
                        'slug' => 'grabfood',
                        'logo' => '🍔',
                        'description' => 'Food delivery service',
                        'fields' => ['Grab Account', 'Restaurant Name']
                    ],
                    [
                        'name' => 'Foodpanda',
                        'slug' => 'foodpanda',
                        'logo' => '🐼',
                        'description' => 'Online food ordering',
                        'fields' => ['Foodpanda ID', 'Order Details']
                    ],
                    [
                        'name' => 'McDonald\'s Delivery',
                        'slug' => 'mcdonalds',
                        'logo' => '🍟',
                        'description' => 'Fast food delivery',
                        'fields' => ['Order Number', 'Delivery Address']
                    ],
                    [
                        'name' => 'Starbucks',
                        'slug' => 'starbucks',
                        'logo' => '☕',
                        'description' => 'Coffee and beverages',
                        'fields' => ['Starbucks Card', 'Store Location']
                    ]
                ]
            ],
            [
                'name' => 'E-commerce & Shopping',
                'slug' => 'shopping',
                'icon' => 'fas fa-shopping-cart',
                'color' => '#EC4899',
                'description' => 'Online shopping and marketplaces',
                'companies' => [
                    [
                        'name' => 'Shopee',
                        'slug' => 'shopee',
                        'logo' => '🛍️',
                        'description' => 'Online shopping platform',
                        'fields' => ['Order Number', 'Seller Name']
                    ],
                    [
                        'name' => 'Lazada',
                        'slug' => 'lazada',
                        'logo' => '📦',
                        'description' => 'E-commerce marketplace',
                        'fields' => ['Lazada Order ID', 'Product Code']
                    ],
                    [
                        'name' => 'Zalora',
                        'slug' => 'zalora',
                        'logo' => '👗',
                        'description' => 'Fashion and lifestyle',
                        'fields' => ['Zalora Account', 'Item Code']
                    ],
                    [
                        'name' => 'Amazon',
                        'slug' => 'amazon',
                        'logo' => '📋',
                        'description' => 'Global marketplace',
                        'fields' => ['Amazon Account', 'ASIN Code']
                    ]
                ]
            ],
            [
                'name' => 'Government Services',
                'slug' => 'government',
                'icon' => 'fas fa-landmark',
                'color' => '#6366F1',
                'description' => 'Government fees, taxes, and official payments',
                'companies' => [
                    [
                        'name' => 'BIR Tax Payment',
                        'slug' => 'bir',
                        'logo' => '🏛️',
                        'description' => 'Bureau of Internal Revenue',
                        'fields' => ['TIN Number', 'Tax Type']
                    ],
                    [
                        'name' => 'SSS Contributions',
                        'slug' => 'sss',
                        'logo' => '👥',
                        'description' => 'Social Security System',
                        'fields' => ['SSS Number', 'Period Covered']
                    ],
                    [
                        'name' => 'PhilHealth',
                        'slug' => 'philhealth',
                        'logo' => '🏥',
                        'description' => 'Philippine Health Insurance',
                        'fields' => ['PhilHealth Number', 'Contribution Period']
                    ],
                    [
                        'name' => 'Pag-IBIG Fund',
                        'slug' => 'pagibig',
                        'logo' => '🏠',
                        'description' => 'Home Development Mutual Fund',
                        'fields' => ['Pag-IBIG Number', 'Loan Payment']
                    ]
                ]
            ],
            [
                'name' => 'Insurance',
                'slug' => 'insurance',
                'icon' => 'fas fa-shield-alt',
                'color' => '#0EA5E9',
                'description' => 'Life, health, and property insurance',
                'companies' => [
                    [
                        'name' => 'Sun Life Financial',
                        'slug' => 'sun-life',
                        'logo' => '☀️',
                        'description' => 'Life and health insurance',
                        'fields' => ['Policy Number', 'Premium Amount']
                    ],
                    [
                        'name' => 'AXA Philippines',
                        'slug' => 'axa',
                        'logo' => '🛡️',
                        'description' => 'Insurance and investment',
                        'fields' => ['AXA Policy ID', 'Payment Type']
                    ],
                    [
                        'name' => 'Prudential',
                        'slug' => 'prudential',
                        'logo' => '🏢',
                        'description' => 'Life insurance company',
                        'fields' => ['Prudential Number', 'Plan Details']
                    ],
                    [
                        'name' => 'MAPFRE Insular',
                        'slug' => 'mapfre',
                        'logo' => '🚗',
                        'description' => 'Auto and property insurance',
                        'fields' => ['Policy Reference', 'Vehicle Plate']
                    ]
                ]
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'icon' => 'fas fa-graduation-cap',
                'color' => '#059669',
                'description' => 'Tuition, courses, and educational services',
                'companies' => [
                    [
                        'name' => 'University of the Philippines',
                        'slug' => 'up',
                        'logo' => '🎓',
                        'description' => 'State university tuition',
                        'fields' => ['Student Number', 'Semester']
                    ],
                    [
                        'name' => 'Ateneo de Manila',
                        'slug' => 'ateneo',
                        'logo' => '📚',
                        'description' => 'Private university fees',
                        'fields' => ['Ateneo ID', 'Academic Year']
                    ],
                    [
                        'name' => 'De La Salle University',
                        'slug' => 'dlsu',
                        'logo' => '🏫',
                        'description' => 'University tuition and fees',
                        'fields' => ['DLSU ID Number', 'Term Period']
                    ],
                    [
                        'name' => 'Coursera',
                        'slug' => 'coursera',
                        'logo' => '💻',
                        'description' => 'Online learning platform',
                        'fields' => ['Coursera Account', 'Course Name']
                    ]
                ]
            ]
        ];
    }
}
