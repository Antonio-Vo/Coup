<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$stateFile = __DIR__ . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);

$slot = $data['slot'];
$name = htmlspecialchars($data['name']);
$playerId = $data['playerId'] ?? null;
$now = time();

$response = ['success' => false, 'message' => ''];

//  Prevent duplicate joins with same playerId
foreach ($state['players'] as $existingPlayer) {
    if (isset($existingPlayer['id']) && $existingPlayer['id'] === $playerId) {
        $response['message'] = "You are already in the game.";
        echo json_encode($response);
        exit;
    }
}

//  Assign player if slot is free
if (isset($state['players'][$slot]) && $state['players'][$slot]['name'] === null) {
    $state['players'][$slot] = [
        'name' => $name,
        'id' => $playerId,
        'lastSeen' => $now
    ];
    $state['log'][] = "$name joined slot " . ($slot + 1);
    file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));
    $response['success'] = true;
    $response['message'] = "Joined successfully.";
}

echo json_encode($response);
?>
