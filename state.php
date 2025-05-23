<?php
// DB connection
$db = new PDO(
  'mysql:sql304.byethost31.com;dbname=b31_38711838_coup_lobby;charset=utf8mb4',
  'sql304.byethost31.com',
  'Class2025',
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// 1. Get or create user ID cookie
if (empty($_COOKIE['lobby_user_id'])) {
  $userId = bin2hex(random_bytes(16)); // generate unique ID
  setcookie('lobby_user_id', $userId, time() + 86400, '/'); // valid 1 day
} else {
  $userId = $_COOKIE['lobby_user_id'];
}

// 2. Record ping (insert or update)
$stmt = $db->prepare("
  INSERT INTO lobby_users (user_id, last_ping)
  VALUES (?, NOW())
  ON DUPLICATE KEY UPDATE last_ping = NOW()
");
$stmt->execute([$userId]);

// 3. Remove users idle >30 seconds
$db->prepare("DELETE FROM lobby_users WHERE last_ping < NOW() - INTERVAL 30 SECOND")
   ->execute();

// 4. Get all active users
$users = $db->query("SELECT user_id FROM lobby_users")->fetchAll(PDO::FETCH_COLUMN);

// 5. Count deck cards
$deckCount = $db->query("SELECT COUNT(*) FROM lobby_cards WHERE location = 'deck'")->fetchColumn();

// 6. Count cards in each user’s hand
$hands = $db->query("
  SELECT owner_id, COUNT(*) as count
  FROM lobby_cards
  WHERE location = 'hand'
  GROUP BY owner_id
")->fetchAll(PDO::FETCH_KEY_PAIR);

// 7. Get cards on the table
$tableCards = $db->query("
  SELECT card_name FROM lobby_cards
  WHERE location = 'table'
")->fetchAll(PDO::FETCH_COLUMN);

// 8. Return JSON
header('Content-Type: application/json');
echo json_encode([
  'your_id' => $userId,
  'users' => $users,
  'deck_count' => (int)$deckCount,
  'hands' => $hands,
  'table' => $tableCards,
]);
