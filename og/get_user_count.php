<?php
$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
echo json_encode(['count' => count($users)]);
?>
