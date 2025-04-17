<?php
session_start();

$file = 'users.json';
$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$session_id = session_id();
$users[$session_id] = time(); // store last activity time

// Clean up users who were inactive for over 60 seconds
$users = array_filter($users, fn($lastActive) => time() - $lastActive <= 60);

file_put_contents($file, json_encode($users));
?>
