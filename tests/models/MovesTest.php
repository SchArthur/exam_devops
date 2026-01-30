<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestWith;

use Models\Moves;

final class MovesTest extends TestCase
{
    #[TestWith([['Pierre', 'Feuille', 'Ciseaux', 'Lézard', 'Spock']])]
    public function testGetAllMovesShouldReturnValues(array $values): void
    {
        $movesModel = new Moves();
        $this->assertEquals($values, $movesModel->getAllMoves());
    }

    #[TestWith([['Pierre', 'Feuille', 'Ciseaux', 'Lézard', 'Spock']])]
    public function testGetRandomMoveShouldReturnValidMove(array $values): void
    {
        $movesModel = new Moves();
        $randomMove = $movesModel->getRandomMove();
        $this->assertContains($randomMove, $values);
    }

    #[TestWith(['Pierre'])]
    #[TestWith(['Feuille'])]
    #[TestWith(['Ciseaux'])]
    #[TestWith(['Lézard'])]
    #[TestWith(['Spock'])]
    #[TestWith(['CISEAUX'])]
    #[TestWith(['LéZaRd'])]
    #[TestWith(['feuille'])]
    #[TestWith(['spock'])]

    public function testIsValidMoveWithValidMovesShouldReturnTrue($move): void
    {
        $movesModel = new Moves();
        $this->assertTrue($movesModel->isValidMove($move));
    }

    #[TestWith(['InvalidMove'])]
    #[TestWith([''])]
    #[TestWith(['123'])]
    #[TestWith(['Rock'])]
    #[TestWith(['Paper'])]
    #[TestWith(['Pierre '])]
    public function testIsValidMoveWithInvalidMovesShouldReturnFalse($move): void
    {
        $movesModel = new Moves();
        $this->assertFalse($movesModel->isValidMove($move));
    }
}