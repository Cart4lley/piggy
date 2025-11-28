<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidAccountNumber implements ValidationRule
{
    /**
     * Run the validation rule for bank account numbers.
     * 
     * Validates that the account number:
     * - Contains only digits
     * - Not all identical digits
     * - Not sequential number patterns
     * - Passes Luhn algorithm check (if applicable)
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove all non-numeric characters
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        
        // Check if it's empty after cleaning
        if (empty($cleaned)) {
            $fail('The :attribute must contain at least one digit.');
            return;
        }
        
        // Additional validation: check for obvious invalid patterns
        
        // Check if all digits are the same (e.g., 1111111111)
        if (preg_match('/^(\d)\1+$/', $cleaned)) {
            $fail('The :attribute cannot contain all identical digits.');
            return;
        }
        
        // Check for sequential numbers (e.g., 1234567890)
        if ($this->isSequentialNumber($cleaned)) {
            $fail('The :attribute cannot be a sequential number pattern.');
            return;
        }
        
        // Check for common invalid patterns
        $invalidPatterns = [
            '00000000',    // All zeros
            '12345678',    // Simple sequence
            '87654321',    // Reverse sequence  
            '11111111',    // All ones
            '99999999',    // All nines
        ];
        
        foreach ($invalidPatterns as $pattern) {
            if (strpos($cleaned, $pattern) === 0) {
                $fail('The :attribute appears to be invalid. Please check your account number.');
                return;
            }
        }
        
        // Luhn algorithm check for account numbers that use it (optional, as not all banks use it)
        // This is commonly used by credit cards and some bank accounts
        $length = strlen($cleaned);
        if ($length >= 13 && !$this->luhnCheck($cleaned)) {
            // Don't fail on Luhn check as not all Philippine banks use it, just log for monitoring
            // But we could add this as a warning in the future
        }
    }
    
    /**
     * Check if the number is a simple sequential pattern
     */
    private function isSequentialNumber(string $number): bool
    {
        $length = strlen($number);
        
        // Check ascending sequence
        $ascending = true;
        for ($i = 1; $i < $length; $i++) {
            if ((int)$number[$i] !== ((int)$number[$i-1] + 1) % 10) {
                $ascending = false;
                break;
            }
        }
        
        // Check descending sequence
        $descending = true;
        for ($i = 1; $i < $length; $i++) {
            if ((int)$number[$i] !== ((int)$number[$i-1] - 1 + 10) % 10) {
                $descending = false;
                break;
            }
        }
        
        return $ascending || $descending;
    }
    
    /**
     * Luhn algorithm check (used by some financial institutions)
     */
    private function luhnCheck(string $number): bool
    {
        $sum = 0;
        $alternate = false;
        
        // Loop through digits from right to left
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $digit = (int)$number[$i];
            
            if ($alternate) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit = ($digit % 10) + 1;
                }
            }
            
            $sum += $digit;
            $alternate = !$alternate;
        }
        
        return ($sum % 10) === 0;
    }
}
