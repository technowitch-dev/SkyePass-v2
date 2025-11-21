<?php

function hash_function($string1, $string2) {
    // Combine the two input strings
    $combined = $string1 . $string2;
    
    // Define character sets
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $special = '!@#$%^&*()_+-=[]{}|;:,.<>?';
    
    // Create a combined character set
    $allChars = $uppercase . $lowercase . $numbers . $special;
    
    // Create a hash of the combined string
    $hash = hash('sha256', $combined);
    
    // Build the 15-character hash
    $result = '';

    // Ensure at least one character from each required category
    $result .= $uppercase[hexdec(substr($hash, 0, 2)) % strlen($uppercase)];
    $result .= $lowercase[hexdec(substr($hash, 2, 2)) % strlen($lowercase)];
    $result .= $numbers[hexdec(substr($hash, 4, 2)) % strlen($numbers)];
    $result .= $special[hexdec(substr($hash, 6, 2)) % strlen($special)];
    
    // Fill remaining 11 characters from all character sets
    for ($i = 4; $i < 15; $i++) {
        // Use hash bytes to determine character selection
        $hashByte = hexdec(substr($hash, ($i * 2) % strlen($hash), 2));
        $charIndex = $hashByte % strlen($allChars);
        $result .= $allChars[$charIndex];
    }
    
    // Shuffle the result to randomize position of required characters
    $resultArray = str_split($result);
    for ($i = 0; $i < 15; $i++) {
        $swapIndex = hexdec(substr($hash, ($i * 2) % 64, 2)) % 15;
        $temp = $resultArray[$i];
        $resultArray[$i] = $resultArray[$swapIndex];
        $resultArray[$swapIndex] = $temp;
    }
    
    return implode('', $resultArray);
}

// Example usage
$string1 = "skye";
$string2 = "walker";
$hash = hash_function($string1, $string2);
//echo "Hash: " . $hash . "\n";
//echo "Length: " . strlen($hash) . "\n";