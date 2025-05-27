<?php
// actions taken while it is player's turn
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
                break;
            }
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

if (!$playerFound) {
    $state['log'][] = "Error: Player with ID $playerId not found.";
}
    }
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