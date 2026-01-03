<?php
namespace Bga\Games\Gloomies\NewGame;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/NewGame/PlayersNewGame.php');

//include_once(__DIR__.'/../../export/modules/php/Infrastructure/Player.php');
//use Bga\Games\Gloomies\Infrastructure\PlayerFactory;

include_once(__DIR__.'/../../_ide_helper.php');
use Bga\GameFramework\Components\Deck;
use Bga\GameFramework\Components\Counters\PlayerCounter;

#[\PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations]
class PlayersNewGameTest extends TestCase{
    const NEXT_PLAYER_TABLE = [
            1000 => 2000, 
            2000 => 3000, 
            3000 => 4000, 
            4000 => 1000, 
            0 => 1000 
    ];

    protected ?PlayersNewGame $sut = null;
    protected ?Deck $mock_cards = null;

    public function setup(): void {
        $this->mock_cards = $this->createMock(Deck::class);
        $this->sut = PlayersNewGame::create($this->mock_cards);
    }

    /**
     */
    public function test_helpers_1players() {
        // Arrange
        $this->set_number_players(1);

        $mock_counter = $this->createMock(PlayerCounter::class);
        $mock_counter->expects($this->exactly(1))->method('set')->with(1000, 1);
        // Act
        $this->sut->setup_helpers($mock_counter);
        // Assert
    }

    /**
     */
    public function test_helpers_4players() {
        // Arrange
        $this->set_number_players(4);
        $count_per_player_order = [1, 4, 5, 2];
        $expected_helpers = [
                1000 => 1, 
                2000 => 4, 
                3000 => 5, 
                4000 => 2, 
        ];

        // Act
        $helpers = $this->sut->get_count_per_player($count_per_player_order);
        // Assert
        $this->assertEquals($expected_helpers, $helpers);
    }

    /**
     */
    public function test_flower_cards() {
        // Arrange
        $this->set_number_players(1);
        $this->mock_cards->expects($this->exactly(1))->method('pickCards')->with(4, 'deck', 1000);
        // Act
        $this->sut->setup_flower_cards();
        // Assert
    }

    protected function set_number_players($number): void {
        $table = self::NEXT_PLAYER_TABLE;
        $table[$number * 1000] = 1000;

        $this->sut->set_nextPlayerTable($table);
    }
}
?>
