<?php
namespace Bga\Games\Gloomies\NewGame;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/NewGame/BonusTilesNewGame.php');

include_once(__DIR__.'/../../export/modules/php/Infrastructure/BonusTile.php');
use Bga\Games\Gloomies\Infrastructure\BonusTileFactory;

include_once(__DIR__.'/../../_ide_helper.php');

class BonusTilesNewGameTest extends TestCase{
    protected ?BonusTilesNewGame $sut = null;
    protected ?BonusTileFactory $mock_factory = null;

    public function setup(): void {
        $this->mock_factory = $this->createMock(BonusTileFactory::class);
        $this->sut = BonusTilesNewGame::create($this->mock_factory);
    }

    /**
     */
    public function test_BonusTile_creation() {
        // Arrange
        $this->mock_factory->expects($this->exactly(1))->method('flush');
        $this->mock_factory->expects($this->exactly(24))->method('add');
        // Act
        $this->sut->setup();
        // Assert
    }
}
?>
