<?php
$stateFile = __DIR__ . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);
$state['started'] = true;
file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));
echo json_encode(['success' => true]);