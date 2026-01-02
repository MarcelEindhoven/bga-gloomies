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

include_once(__DIR__.'/../../export/modules/php/Infrastructure/Flower.php');
use Bga\Games\Gloomies\Infrastructure\FlowerFactory;

include_once(__DIR__.'/../../_ide_helper.php');

class FlowersNewGameTest extends TestCase{
    protected ?FlowersNewGame $sut = null;
    protected ?FlowerFactory $mock_factory = null;

    public function setup(): void {
        $this->mock_factory = $this->createMock(FlowerFactory::class);
        $this->sut = FlowersNewGame::create($this->mock_factory);
    }

    /**
     */
    public function test_flower_creation() {
        // Arrange
        $this->mock_factory->expects($this->exactly(4))->method('flush');
        $this->mock_factory->expects($this->exactly(60))->method('add');
        // Act
        $this->sut->setup();
        // Assert
    }
}
?>
