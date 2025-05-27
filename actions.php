<?php
// actions taken while it is player's turn

function advanceTurn(&$state) {
    $numPlayers = 0;
    foreach ($state['players'] as $player) {
        if (!empty($player['id'])) {
            $numPlayers++;
        }
    }
    if ($numPlayers === 0) return;
    $state = json_decode(file_get_contents($stateFile), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Failed to decode JSON: " . json_last_error_msg());
    }
}

function income($playerId) {
    $stateFile = __DIR__ . '/state.json';
    $state = json_decode(file_get_contents($stateFile), true);

    foreach ($state['players'] as &$player) {
        if ($player['id'] === $playerId) {
            if (!array_key_exists('coins', $player)) {
                $player['coins'] = 0;
            }
            $player['coins'] += 1;
            $state['log'][] = $player['name'] . " took Income (+1 coin)";
            break;
            }
        }
    $result = file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));
    if ($result === false) {
        throw new Exception("Failed to save state to file: $stateFile");
    }
    }
    
    file_put_contents($stateFile, json_encode($state, JSON_PRETTY_PRINT));


function foreignAid($playerId){
$stateFile = __DIR__ . '/state.json';
$state = json_decode(file_get_contents($stateFile), true);
$playerFound = false;
foreach ($state['players'] as &$player) {
        if ($player['id'] === $playerId) {
            $playerFound = true;
            if (!isset($player['coins'])) {
                $player['coins'] = 0;
            }
            $player['coins'] += 2;
            $state['log'][] = $player['name'] . " took foreign Aid (+2 coin)";
            break;
        }
    }

advanceTurn($state);
}

function coup(){

}

function tax(){

}

function assassinate(){

}

function exchange(){

}

function steal(){

}

/// below are counter actions that are only playable when it is not the player's turn