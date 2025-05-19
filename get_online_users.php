<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$threshold = time() - 300;

try {
    $db = new PDO("mysql:host=sql304.byethost31.com;dbname=b31_38711838_online_users", "b31_38711838", "Class2025");
    $stmt = $db->prepare("SELECT COUNT(*) FROM online_users WHERE last_active >= ?");
    $stmt->execute([$threshold]);
    echo $stmt->fetchColumn();
} catch (PDOException $e) {
    http_response_code(500);
    echo "0";
}
?>
