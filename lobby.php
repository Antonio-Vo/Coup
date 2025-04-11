<?php
$code = $_GET['code'] ?? '';
$lobbies = json_decode(file_get_contents('lobbies.json'), true);

if (isset($lobbies[$code])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Lobby not found']);
}
?>