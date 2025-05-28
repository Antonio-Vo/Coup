<?php
header('Content-Type: application/json');

$stateFile = __DIR__ . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);

$data = json_decode(file_get_contents('php://input'), true);
$name = $data['name'] ?? null;
$slot = $data['slot'] ?? null;
$playerId = $data['playerId'] ?? null;

$response = ['success' => false, 'message' => ''];

if (!$name || $slot === null || !$playerId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing data']);
    exit;
}

// Prevent a player from joining multiple slots
foreach ($state['players'] as $existingPlayer) {
    if (isset($existingPlayer['id']) && $existingPlayer['id'] === $playerId) {
        $response['message'] = "You are already in the game.";
        echo json_encode($response);
        exit;
    }
}

// Assign player to the selected slot if it's empty
if (empty($state['players'][$slot]['id'])) {
    $state['players'][$slot]['name'] = $name;
    $state['players'][$slot]['id'] = $playerId;
    $state['players'][$slot]['coins'] = 2;
    $state['players'][$slot]['cards'] = [null, null]; // or assign cards as needed
    $state['players'][$slot]['lastSeen'] = time();
    $state['log'][] = "$name joined slot " . ($slot + 1);
    file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));
    $response['success'] = true;
    $response['message'] = "Joined successfully.";
} else {
    http_response_code(400);
    $response['message'] = "Slot already taken.";
}

echo json_encode($response);
?>
