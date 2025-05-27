<?php
$stateFile = __DIR__ . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);

// Count joined players
$joined = 0;
foreach ($state['players'] as $player) {
    if (!empty($player['id'])) $joined++;
}
// start the game only if at least 2 players have joined
if ($joined < 2) {
    http_response_code(400);
    echo json_encode(['error' => 'At least 2 players required to start.']);
    exit;
}

$state['started'] = true;
file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));
echo json_encode(['success' => true]);