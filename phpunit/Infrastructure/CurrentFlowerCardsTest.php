<?php
namespace Bga\Games\Gloomies\Infrastructure;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/Infrastructure/FlowerCard.php');

include_once(__DIR__.'/../../_ide_helper.php');
use \Bga\GameFramework\Components\Deck;

#[\PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations]
class CurrentFlowerCardsTest extends TestCase{
    protected ?CurrentFlowerCards $sut = null;
    protected ?Deck $mock_cards = null;
    protected array $default_single_card = array( 'id' => '2', 'type' => '3', 'type_arg' => '0', 'location' => 'market', 'location_arg' => '2' );
    protected array $default_single_bonus = array( 'location' => 'market', 'type' => 'sun_thistle', 'joker_type' => 'no_flower', 'position' => 2);

    public function setup(): void {
        $this->mock_cards = $this->createMock(Deck::class);
        $this->sut = new CurrentFlowerCards($this->mock_cards);
    }

    public function test_get_with_empty_deck() {
        // Arrange
        $this->mock_cards->expects($this->exactly(1))->method('getCardsInLocation')->willReturn([]);
        // Act
        $bonus = $this->sut->get();
        // Assert
        $this->assertEquals([], $bonus);
    }

    public function test_get_with_card() {
        // Arrange
        $this->mock_cards->expects($this->exactly(1))->method('getCardsInLocation')->with('market')->willReturn([$this->default_single_card]);
        // Act
        $bonus = $this->sut->get('market');
        // Assert
        $this->assertEquals([$this->default_single_bonus], $bonus);
    }

    public function test_get_from_card() {
        // Arrange
        // Act
        $bonus = $this->sut->get_from_card($this->default_single_card);
        // Assert
        $this->assertEquals($this->default_single_bonus, $bonus);
    }
}
?>
