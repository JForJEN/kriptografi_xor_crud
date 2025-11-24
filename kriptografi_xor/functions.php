<?php
include 'db.php';

// fungsi XOR
function xor_encrypt($data, $key = "kunci123") {
    $output = '';
    for ($i = 0; $i < strlen($data); $i++) {
        $output .= chr(ord($data[$i]) ^ ord($key[$i % strlen($key)]));
    }
    return $output;
}

// simpan log
function create_log($action, $plaintext, $ciphertext) {
    global $conn;

    $plaintext_safe = mysqli_real_escape_string($conn, $plaintext);
    $cipher_safe = mysqli_real_escape_string($conn, $ciphertext);

    $sql = "INSERT INTO logs (action, plaintext, ciphertext) VALUES ('$action', '$plaintext_safe', '$cipher_safe')";
    mysqli_query($conn, $sql);
}
?>