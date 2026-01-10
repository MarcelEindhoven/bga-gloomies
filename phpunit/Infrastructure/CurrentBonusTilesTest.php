<?php
namespace Bga\Games\Gloomies\Infrastructure;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/Infrastructure/BonusTile.php');

include_once(__DIR__.'/../../_ide_helper.php');
use \Bga\GameFramework\Components\Deck;

#[\PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations]
class CurrentBonusTilesTest extends TestCase{
    protected ?CurrentBonusTiles $sut = null;
    protected ?Deck $mock_cards = null;
    protected array $default_purple_card = array( 'id' => '2', 'type' => '3', 'type_arg' => '0', 'location' => 'purple', 'location_arg' => '52' );
    protected array $default_purple_bonus = array( 'location' => 'purple', 'type' => 'order_card', 'indentation' => 5, 'depth' => 2);

    public function setup(): void {
        $this->mock_cards = $this->createMock(Deck::class);
        $this->sut = new CurrentBonusTiles($this->mock_cards);
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
        $this->mock_cards->expects($this->exactly(1))->method('getCardsInLocation')->willReturn([$this->default_purple_card]);
        // Act
        $bonus = $this->sut->get();
        // Assert
        $this->assertEquals([$this->default_purple_bonus], $bonus);
    }

    public function test_get_from_card() {
        // Arrange
        // Act
        $bonus = $this->sut->get_from_card($this->default_purple_card);
        // Assert
        $this->assertEquals($this->default_purple_bonus, $bonus);
    }
}
?>
