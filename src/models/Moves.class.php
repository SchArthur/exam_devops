<?php

namespace Models;

class Moves
{
    public function getAllMoves(): array
    {
        return [
            'Pierre',
            'Feuille',
            'Ciseaux',
            'Lézard',
            'Spock'
        ]; // Chemin 1
    }

    public function getRandomMove(): string
    {
        $allMoves = $this->getAllMoves();
        return $allMoves[array_rand($allMoves)]; // Chemin 1
    }

    public function isValidMove(string $move): bool
    {
        $allMoves = $this->getAllMoves();
        foreach ($allMoves as $validMove) {
            if (strtolower($move) === strtolower($validMove)) {
                return true; // Chemin 1
            }
        }
        return false; // Chemin 2
    }
}
