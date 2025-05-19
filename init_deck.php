<?php
// — common header: connect to your DB
$db = new PDO(
  'mysql:sql304.byethost31.com;dbname=b31_38711838_coup_lobby;charset=utf8mb4',
  '	b31_38711838',
  'Class2025',
  [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

// 1. Define your master card list (3 copies of each role)
$cards = [
  'Duke','Duke','Duke',
  'Assassin','Assassin','Assassin',
  'Captain','Captain','Captain',
  'Contessa','Contessa','Contessa',
  'Ambassador','Ambassador','Ambassador'
];

// 2. Shuffle it randomly
shuffle($cards);

// 3. Clear any existing cards
$db->exec("TRUNCATE TABLE lobby_cards");

// 4. Insert each card as “in the deck”
$insert = $db->prepare("
  INSERT INTO lobby_cards (location, owner_id, card_name)
  VALUES ('deck', NULL, ?)
");

foreach ($cards as $cardName) {
    $insert->execute([$cardName]);
}

echo "Initialized deck with " . count($cards) . " cards.\n";
