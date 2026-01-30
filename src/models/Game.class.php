<?php

namespace Models;

class Game
{
    private $movesModel;

    public function __construct()
    {
        $this->movesModel = new Moves();
    }

    public function playRound()
    {
        // Get player move
        echo "Choisissez votre coup :\n";
        $handle = fopen("php://stdin", "r");
        $line = fgets(stream: $handle);
        $choice_str = trim($line);
                
        // Validate input
        if (!$this->movesModel->isValidMove($choice_str)) {
            echo "Choix invalide!\n";
            echo "Les choix valides sont : " . implode(", ", $this->movesModel->getAllMoves()) . "\n";
        }
                
        // Get computer move
        $computerMove = $this->movesModel->getRandomMove();
                
        // Determine winner
        $winner = $this->checkRoundWinner($choice_str, $computerMove);
                
        // Display results
        echo "\nVous avez joué : " . ucfirst($choice_str) . "\n";
        echo "L'ordinateur a joué : " . ucfirst($computerMove) . "\n";
        echo "Résultat : " . $winner . "\n";
    }

    public function checkRoundWinner($playerMove, $computerMove)
    {
        $playerMoveLower = strtolower($playerMove);
        $computerMoveLower = strtolower($computerMove);

        $winningCombinations = [
            'pierre' => [['name'=>'ciseaux', 'action'=>'La pierre casse les ciseaux'], ['name'=>'lézard', 'action'=>'La pierre écrase le lézard']],
            'feuille' => [['name'=>'pierre', 'action'=>'La feuille couvre la pierre'], ['name'=>'spock', 'action'=>'La feuille démontre Spock']],
            'ciseaux' => [['name'=>'feuille', 'action'=>'Les ciseaux coupent la feuille'], ['name'=>'lézard', 'action'=>'Les ciseaux décapitent le lézard']],
            'lézard' => [['name'=>'spock', 'action'=>'Le lézard empoisonne Spock'], ['name'=>'feuille', 'action'=>'Le lézard mange la feuille']],
            'spock' => [['name'=>'ciseaux', 'action'=>'Spock brise les ciseaux'], ['name'=>'pierre', 'action'=>'Spock vaporise la pierre']]
        ];

        if ($playerMoveLower === $computerMoveLower) {
            return 'Égalité'; // Chemin 1
        }
        foreach ($winningCombinations[$playerMoveLower] as $combination) {
            if ($combination['name'] === $computerMoveLower) {
                return 'Vous gagnez! ' . $combination['action']; // Chemin 3
            }
        }
        foreach ($winningCombinations[$computerMoveLower] as $combination) {
            if ($combination['name'] === $playerMoveLower) {
                return 'L\'ordinateur gagne! ' . $combination['action']; // Chemin 4
            }
        }
        throw new \Exception("Invalid combination"); // Chemin 5
    }
}