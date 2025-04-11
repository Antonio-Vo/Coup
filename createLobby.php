<?php
function generateLobbyCode($length = 6) {
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, $length);
}

$filename = 'lobbies.json';
$code = generateLobbyCode();

// Load existing lobbies
$lobbies = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];

// Add new lobby
$lobbies[$code] = [
    'created_at' => date('c'),
    'players' => []  // You can later push usernames here
];

// Save it back
file_put_contents($filename, json_encode($lobbies, JSON_PRETTY_PRINT));

// Return to frontend
echo json_encode(['success' => true, 'code' => $code]);
?>