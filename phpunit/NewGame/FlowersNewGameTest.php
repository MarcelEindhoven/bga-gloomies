<?php
namespace Bga\Games\Gloomies\NewGame;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/NewGame/FlowersNewGame.php');

include_once(__DIR__.'/../../_ide_helper.php');
use \Bga\GameFramework\Components\Deck;

class FlowersNewGameTest extends TestCase{
    protected ?FlowersNewGame $sut = null;
    protected ?Deck $mock_cards = null;

    public function setup(): void {
        $this->mock_cards = $this->createMock(Deck::class);
        $this->sut = FlowersNewGame::create($this->mock_cards);
    }

    /**
     */
    public function test_flower_creation() {
        // Arrange
        // Act
        // Assert
    }
}
?>
