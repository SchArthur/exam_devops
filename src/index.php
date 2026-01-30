<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Models\Game;

$game = new Game();
$game->playRound();