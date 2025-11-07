<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Details - PIGGY Bank</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #FFB6C1 0%, #FF9898 100%);
            min-height: 100vh;
            color: #2d3748;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 80px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .brand-name {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
            font-weight: 700;
            color: #2d3748;
        }

        .user-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #FF9898 0%, #FF7B7B 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 16px;
        }

        /* Main Container */
        .main-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        .breadcrumb {
            margin-bottom: 32px;
        }

        .breadcrumb-link {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
        }

        .breadcrumb-link:hover {
            color: #FF7B7B;
        }

        .breadcrumb-separator {
            margin: 0 8px;
            color: #d1d5db;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.9);
            color: #6b7280;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 32px;
        }

        .back-button:hover {
            background: white;
            color: #374151;
            transform: translateX(-4px);
        }

        /* Transaction Card */
        .transaction-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }

        .transaction-header {
            background: var(--transaction-color);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .transaction-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .transaction-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .transaction-subtitle {
            opacity: 0.9;
            font-size: 16px;
        }

        .transaction-details {
            padding: 40px;
        }

        .details-grid {
            display: grid;
            gap: 24px;
        }

        .detail-group {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            padding: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #6b7280;
            font-size: 14px;
        }

        .detail-value {
            font-weight: 600;
            color: #1f2937;
            font-size: 14px;
        }

        .detail-value.amount {
            font-size: 18px;
        }

        .detail-value.positive {
            color: #059669;
        }

        .detail-value.negative {
            color: #dc2626;
        }

        .transaction-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.1);
            color: #059669;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }

        .status-failed {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .metadata-section {
            margin-top: 20px;
        }

        .metadata-title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .metadata-content {
            background: #f9fafb;
            border-radius: 8px;
            padding: 16px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: #4b5563;
            white-space: pre-wrap;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }

        .btn-primary, .btn-secondary {
            flex: 1;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #FF7B7B;
            color: white;
        }

        .btn-primary:hover {
            background: #FF5E5E;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 16px;
                height: 70px;
            }

            .main-container {
                padding: 20px 16px;
            }

            .transaction-header {
                padding: 24px;
            }

            .transaction-details {
                padding: 24px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-piggy-bank"></i>
                </div>
                <span class="brand-name">PIGGY</span>
            </div>

            <div class="user-section">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->first_name ?? $user->name, 0, 1)) }}{{ strtoupper(substr($user->last_name ?? '', 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3>{{ $user->first_name ?? $user->name }} {{ $user->last_name ?? '' }}</h3>
                        <p>{{ $account->account_number }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="breadcrumb">
            <a href="{{ route('history.index') }}" class="breadcrumb-link">
                <i class="fas fa-history"></i> Transaction History
            </a>
            <span class="breadcrumb-separator">/</span>
            <span>Transaction Details</span>
        </div>

        <a href="{{ route('history.index') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
            Back to History
        </a>

        @php
            $colors = [
                'deposit' => '#10b981',
                'withdrawal' => '#ef4444',
                'transfer' => '#3b82f6',
                'payment' => '#8b5cf6'
            ];
            $icons = [
                'deposit' => 'fas fa-plus-circle',
                'withdrawal' => 'fas fa-minus-circle',
                'transfer' => 'fas fa-exchange-alt',
                'payment' => 'fas fa-credit-card'
            ];
        @endphp

        <div class="transaction-card" style="--transaction-color: {{ $colors[$transaction->type] }}">
            <div class="transaction-header">
                <div class="transaction-icon">
                    <i class="{{ $icons[$transaction->type] }}"></i>
                </div>
                <h1 class="transaction-title">{{ ucfirst($transaction->type) }}</h1>
                <p class="transaction-subtitle">{{ $transaction->description }}</p>
            </div>

            <div class="transaction-details">
                <div class="details-grid">
                    <!-- Basic Information -->
                    <div class="detail-group">
                        <div class="detail-row">
                            <span class="detail-label">Transaction ID</span>
                            <span class="detail-value">
                                <code style="background: #f3f4f6; padding: 4px 8px; border-radius: 4px;">
                                    {{ $transaction->transaction_id }}
                                </code>
                            </span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Reference Number</span>
                            <span class="detail-value">{{ $transaction->reference_number }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Date & Time</span>
                            <span class="detail-value">{{ $transaction->created_at->format('F j, Y \a\t g:i A') }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Status</span>
                            <span class="transaction-status status-{{ $transaction->status }}">
                                @if($transaction->status === 'completed')
                                    <i class="fas fa-check-circle"></i>
                                @elseif($transaction->status === 'pending')
                                    <i class="fas fa-clock"></i>
                                @else
                                    <i class="fas fa-times-circle"></i>
                                @endif
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Amount Information -->
                    <div class="detail-group">
                        <div class="detail-row">
                            <span class="detail-label">Amount</span>
                            <span class="detail-value amount {{ $transaction->type === 'deposit' || ($transaction->type === 'transfer' && $transaction->amount > 0) ? 'positive' : 'negative' }}">
                                {{ $transaction->type === 'deposit' || ($transaction->type === 'transfer' && $transaction->amount > 0) ? '+' : '-' }}₱{{ number_format(abs($transaction->amount), 2) }}
                            </span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Balance Before</span>
                            <span class="detail-value">₱{{ number_format($transaction->balance_before, 2) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Balance After</span>
                            <span class="detail-value">₱{{ number_format($transaction->balance_after, 2) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Net Change</span>
                            <span class="detail-value {{ $transaction->balance_after > $transaction->balance_before ? 'positive' : 'negative' }}">
                                {{ $transaction->balance_after > $transaction->balance_before ? '+' : '' }}₱{{ number_format($transaction->balance_after - $transaction->balance_before, 2) }}
                            </span>
                        </div>
                    </div>

                    @if($transaction->metadata)
                    <!-- Metadata Section -->
                    <div class="detail-group">
                        <div class="metadata-section">
                            <div class="metadata-title">
                                <i class="fas fa-info-circle"></i>
                                Additional Details
                            </div>
                            @php
                                $metadata = json_decode($transaction->metadata, true);
                            @endphp
                            
                            @if($metadata)
                                @foreach($metadata as $key => $value)
                                <div class="detail-row">
                                    <span class="detail-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                    <span class="detail-value">{{ is_array($value) ? implode(', ', $value) : $value }}</span>
                                </div>
                                @endforeach
                            @else
                                <div class="metadata-content">{{ $transaction->metadata }}</div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <div class="action-buttons">
                    <a href="{{ route('history.index') }}" class="btn-secondary">
                        <i class="fas fa-list"></i>
                        View All Transactions
                    </a>
                    <button onclick="printTransaction()" class="btn-primary">
                        <i class="fas fa-print"></i>
                        Print Receipt
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printTransaction() {
            // Create a printable version
            const printContent = `
                <div style="font-family: Arial, sans-serif; max-width: 400px; margin: 0 auto; padding: 20px;">
                    <div style="text-align: center; margin-bottom: 20px;">
                        <h1 style="color: #FF7B7B; margin: 0;">PIGGY Bank</h1>
                        <p style="margin: 5px 0 0 0; color: #666;">Transaction Receipt</p>
                    </div>
                    
                    <div style="border-top: 2px solid #eee; padding-top: 15px;">
                        <table style="width: 100%; font-size: 14px;">
                            <tr><td><strong>Transaction ID:</strong></td><td>${'{{ $transaction->transaction_id }}'}</td></tr>
                            <tr><td><strong>Type:</strong></td><td>${'{{ ucfirst($transaction->type) }}'}</td></tr>
                            <tr><td><strong>Description:</strong></td><td>${'{{ $transaction->description }}'}</td></tr>
                            <tr><td><strong>Amount:</strong></td><td>${'{{ ($transaction->type === "deposit" || ($transaction->type === "transfer" && $transaction->amount > 0)) ? "+" : "-" }}₱{{ number_format(abs($transaction->amount), 2) }}'}</td></tr>
                            <tr><td><strong>Date:</strong></td><td>${'{{ $transaction->created_at->format("M j, Y g:i A") }}'}</td></tr>
                            <tr><td><strong>Reference:</strong></td><td>${'{{ $transaction->reference_number }}'}</td></tr>
                            <tr><td><strong>Status:</strong></td><td>${'{{ ucfirst($transaction->status) }}'}</td></tr>
                        </table>
                    </div>
                    
                    <div style="border-top: 2px solid #eee; margin-top: 15px; padding-top: 15px; text-align: center; font-size: 12px; color: #666;">
                        <p>Thank you for banking with PIGGY!</p>
                        <p>Generated on ${new Date().toLocaleString()}</p>
                    </div>
                </div>
            `;
            
            const printWindow = window.open('', '', 'height=600,width=400');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Transaction Receipt</title>
                        <style>
                            body { margin: 0; padding: 20px; }
                            @media print {
                                body { margin: 0; }
                            }
                        </style>
                    </head>
                    <body>
                        ${printContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        }
    </script>
</body>
</html>