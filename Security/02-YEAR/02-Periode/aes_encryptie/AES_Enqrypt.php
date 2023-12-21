<?php
function encryptAndDecrypt($message, $key) {
    $cipher = "aes-128-gcm";
    
    if (in_array($cipher, openssl_get_cipher_methods())) {
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        
        $ciphertext = openssl_encrypt($message, $cipher, $key, 0, $iv, $tag);
        echo "$ciphertext\n";
        
        $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, 0, $iv, $tag);
        echo "$original_plaintext\n";
    }
}

$message = $argv[1];
$key = $argv[2];

encryptAndDecrypt($message, $key);
?>
