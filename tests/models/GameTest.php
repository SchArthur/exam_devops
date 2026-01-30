<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestWith;

use Models\Game;

final class GameTest extends TestCase
{
    #[TestWith(['Pierre', 'Pierre'])]
    #[TestWith(['Ciseaux', 'Ciseaux'])]
    #[TestWith(['Spock', 'spock'])]
    #[TestWith(['Lézard', 'lézard'])]
    #[TestWith(['FEUILLE', 'feuille'])]
    public function testCheckRoundWinnerWithSameValuesShouldReturnStringTie(string $first_move, string $second_move): void
    {
        $gameModel = new Game();
        $result = $gameModel->checkRoundWinner($first_move, $second_move);
        $this->assertEquals('Égalité', $result);
    }

    #[TestWith(['Pierre', 'Lézard', 'La pierre écrase le lézard'])]
    #[TestWith(['Pierre', 'Ciseaux', 'La pierre casse les ciseaux'])]
    #[TestWith(['Feuille', 'Pierre', 'La feuille couvre la pierre'])]
    #[TestWith(['Feuille', 'Spock', 'La feuille démontre Spock'])]
    #[TestWith(['Ciseaux', 'Feuille', 'Les ciseaux coupent la feuille'])]
    #[TestWith(['Ciseaux', 'Lézard', 'Les ciseaux décapitent le lézard'])]
    #[TestWith(['Lézard', 'Spock', 'Le lézard empoisonne Spock'])]
    #[TestWith(['Lézard', 'Feuille', 'Le lézard mange la feuille'])]
    #[TestWith(['Spock', 'Ciseaux', 'Spock brise les ciseaux'])]
    #[TestWith(['Spock', 'Pierre', 'Spock vaporise la pierre'])]
    public function testCheckRoundWinnerWithPlayerWinningShouldReturnStringPlayerWins(string $first_move, string $second_move, string $result_string): void
    {
        $gameModel = new Game();
        $result = $gameModel->checkRoundWinner($first_move, $second_move);
        $this->assertEquals('Vous gagnez! ' . $result_string, $result);
    }

    #[TestWith(['Lézard', 'Pierre', 'La pierre écrase le lézard'])]
    #[TestWith(['Ciseaux', 'Pierre', 'La pierre casse les ciseaux'])]
    #[TestWith(['Pierre', 'Feuille', 'La feuille couvre la pierre'])]
    #[TestWith(['Spock', 'Feuille', 'La feuille démontre Spock'])]
    #[TestWith(['Feuille', 'Ciseaux', 'Les ciseaux coupent la feuille'])]
    #[TestWith(['Lézard', 'Ciseaux', 'Les ciseaux décapitent le lézard'])]
    #[TestWith(['Spock', 'Lézard', 'Le lézard empoisonne Spock'])]
    #[TestWith(['Feuille', 'Lézard', 'Le lézard mange la feuille'])]
    #[TestWith(['Ciseaux', 'Spock', 'Spock brise les ciseaux'])]
    #[TestWith(['Pierre', 'Spock', 'Spock vaporise la pierre'])]
    public function testCheckRoundWinnerWithComputerWinningShouldReturnStringComputerWins(string $first_move, string $second_move, string $result_string): void
    {
        $gameModel = new Game();
        $result = $gameModel->checkRoundWinner($first_move, $second_move);
        $this->assertEquals('L\'ordinateur gagne! ' . $result_string, $result);
    }

    #[TestWith(['InvalidMove', 'AnotherInvalidMove'])]
    #[TestWith(['Rock', 'Paper'])]
    #[TestWith(['123', '456'])]
    #[TestWith(['Pierre', 'InvalidMove'])]
    public function testCheckRoundWinnerWithInvalidCombinationShouldThrowException(string $first_move, string $second_move): void
    {
        $this->expectException(\Exception::class);
        $gameModel = new Game();
        $gameModel->checkRoundWinner($first_move, $second_move);
    }
}
