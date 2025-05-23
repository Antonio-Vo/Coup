<?php
$data = json_decode(file_get_contents('php://input'), true);
$stateFile = __DIR__ . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);

$slot = $data['slot'];
$name = htmlspecialchars($data['name']);
$playerId = $data['playerId'] ?? null;
$now = time();

if (isset($state['players'][$slot]) && $state['players'][$slot]['name'] === null) {
  $state['players'][$slot] = [
    'name' => $name,
    'id' => $playerId,
    'lastSeen' => $now
  ];
  $state['log'][] = "$name joined slot " . ($slot + 1);
  file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));
}
?>
