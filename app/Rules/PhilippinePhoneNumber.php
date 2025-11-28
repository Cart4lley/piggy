<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PhilippinePhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule for Philippine phone numbers.
     * 
     * Accepts formats:
     * - +63 912 345 6789
     * - +639123456789
     * - 09123456789
     * - 912 345 6789
     * - 9123456789
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove all spaces, dashes, and parentheses
        $cleaned = preg_replace('/[\s\-\(\)]/', '', $value);
        
        // Check various Philippine phone number patterns
        $patterns = [
            '/^\+639[0-9]{9}$/',           // +639123456789 (11 digits after country code)
            '/^639[0-9]{9}$/',             // 639123456789 (without +)
            '/^09[0-9]{9}$/',              // 09123456789 (11 digits starting with 09)
            '/^9[0-9]{9}$/',               // 9123456789 (10 digits starting with 9)
        ];
        
        $isValid = false;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $cleaned)) {
                $isValid = true;
                break;
            }
        }
        
        // Additional validation: check if it's a valid Philippine mobile prefix
        if ($isValid) {
            // Extract the mobile prefix (first 3 digits after country code)
            $prefix = '';
            if (preg_match('/^\+?63?0?([0-9]{3})/', $cleaned, $matches)) {
                $prefix = $matches[1];
            }
            
            // Valid Philippine mobile prefixes
            $validPrefixes = [
                '905', '906', '915', '916', '917', '918', '919', '920', '921', '922', 
                '923', '924', '925', '926', '927', '928', '929', '930', '931', '932',
                '933', '934', '935', '936', '937', '938', '939', '940', '941', '942',
                '943', '944', '945', '946', '947', '948', '949', '950', '951', '952',
                '953', '954', '955', '956', '957', '958', '959', '960', '961', '962',
                '963', '964', '965', '966', '967', '968', '969', '970', '971', '972',
                '973', '974', '975', '976', '977', '978', '979', '980', '981', '982',
                '983', '984', '985', '986', '987', '988', '989', '990', '991', '992',
                '993', '994', '995', '996', '997', '998', '999'
            ];
            
            if (!in_array($prefix, $validPrefixes)) {
                $isValid = false;
            }
        }
        
        if (!$isValid) {
            $fail('The :attribute must be a valid Philippine phone number (e.g., +63 912 345 6789 or 09123456789).');
        }
    }
}
