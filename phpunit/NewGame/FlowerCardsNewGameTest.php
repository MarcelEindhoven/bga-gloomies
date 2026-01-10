<?php
namespace Bga\Games\Gloomies\NewGame;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/NewGame/FlowerCardsNewGame.php');

include_once(__DIR__.'/../../export/modules/php/Infrastructure/FlowerCard.php');
use Bga\Games\Gloomies\Infrastructure\FlowerCardFactory;

include_once(__DIR__.'/../../_ide_helper.php');

#[\PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations]
class FlowerCardsNewGameTest extends TestCase{
    protected ?FlowerCardsNewGame $sut = null;
    protected ?FlowerCardFactory $mock_factory = null;

    public function setup(): void {
        $this->mock_factory = $this->createMock(FlowerCardFactory::class);
        $this->sut = FlowerCardsNewGame::create($this->mock_factory);
    }

    /**
     */
    public function test_FlowerCard_creation() {
        // Arrange
        $this->mock_factory->expects($this->exactly(1))->method('flush');
        $this->mock_factory->expects($this->exactly(14 + 12 + 12 + 8))->method('add_single_type');
        $this->mock_factory->expects($this->exactly(14))->method('add_double_type');
        // Act
        $this->sut->setup();
        // Assert
    }
    public function test_distribution() {
        // Arrange
        $player = array('id' => '2371152', 'score' => '0', 'stardust' => 0, 'helpers' => 1, 'color' => 'ff0000');
        $expected_player = $player;
        $expected_player['initial_number_cards'] = 4;
        $this->mock_factory->expects($this->exactly(1))->method('distribute');
        $this->mock_factory->expects($this->exactly(1))->method('pick_cards')->with([$expected_player]);
        // Act
        $this->sut->setup([$player]);
        // Assert
    }
}
?>
