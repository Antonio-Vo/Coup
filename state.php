<?php
// 1. (Optional) start session if you need $_SESSION later
session_start();

// 2. If our cookie is missing, generate & send it
if (empty($_COOKIE['lobby_user_id'])) {
    $uid = bin2hex(random_bytes(16));      // secure 32-char hex ID
    setcookie('lobby_user_id', $uid, 0, '/');  // session cookie, site-wide
    $_COOKIE['lobby_user_id'] = $uid;          // immediate availability
}

// 3. Our per-browser identifier
$userId = $_COOKIE['lobby_user_id'];

// 4. Database connection (adjust creds to your setup)
$db = new PDO(
  'mysql:sql304.byethost31.com;dbname=b31_38711838_coup_lobby;charset=utf8mb4',
  'db_user',
  'db_pass',
  [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]
);

