<?php
$db = new PDO("mysql:host=sql304.byethost31.com;dbname=b31_38711838_online_users", "b31_38711838", "Class2025");
$threshold = time() - 300;
$stmt = $db->prepare("SELECT COUNT(*) FROM online_users WHERE last_active >= ?");
$stmt->execute([$threshold]);
echo $stmt->fetchColumn();
?>
