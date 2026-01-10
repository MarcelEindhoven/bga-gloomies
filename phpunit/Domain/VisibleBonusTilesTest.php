<?php
namespace Bga\Games\Gloomies\Domain;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/Domain/BonusTiles.php');
include_once(__DIR__.'/../../export/modules/php/Infrastructure/BonusTile.php');

include_once(__DIR__.'/../../_ide_helper.php');
use Bga\Games\Gloomies\Infrastructure\CurrentBonusTiles;

#[\PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations]
class VisibleBonusTilesTest extends TestCase{
    protected ?VisibleBonusTiles $sut = null;
    protected ?CurrentBonusTiles $mock_cards = null;
    protected array $default_purple_card = array( 'id' => '2',  'location' => 'purple', 'type' => 'order_card', 'indentation' => 5, 'depth' => 2);
    protected array $extra_purple_card = array( 'id' => '3',  'location' => 'purple', 'type' => '1_little_helper', 'indentation' => 4, 'depth' => 1);
    protected array $higher_indentation5 = array( 'id' => '4',  'location' => 'purple', 'type' => 'stardust', 'indentation' => 5, 'depth' => 3);
    protected array $default_visible_single_card = array(
        0 => ['number' => 0, 'type' => 'no_bonus'],
        1 => ['number' => 0, 'type' => 'no_bonus'],
        2 => ['number' => 0, 'type' => 'no_bonus'],
        3 => ['number' => 0, 'type' => 'no_bonus'],
        4 => ['number' => 0, 'type' => 'no_bonus'],
        5 => ['number' => 1, 'type' => 'order_card'],
        6 => ['number' => 0, 'type' => 'no_bonus'],
        7 => ['number' => 0, 'type' => 'no_bonus'],
    );

    public function setup(): void {
        $this->mock_cards = $this->createMock(CurrentBonusTiles::class);
        $this->sut = new VisibleBonusTiles($this->mock_cards);
    }

    public function test_get_with_empty_deck() {
        // Arrange
        $expected_visible = array(
            0 => ['number' => 0, 'type' => 'no_bonus'],
            1 => ['number' => 0, 'type' => 'no_bonus'],
            2 => ['number' => 0, 'type' => 'no_bonus'],
            3 => ['number' => 0, 'type' => 'no_bonus'],
            4 => ['number' => 0, 'type' => 'no_bonus'],
            5 => ['number' => 0, 'type' => 'no_bonus'],
            6 => ['number' => 0, 'type' => 'no_bonus'],
            7 => ['number' => 0, 'type' => 'no_bonus'],
        );
        $this->mock_cards->expects($this->exactly(1))->method('get')->willReturn([]);
        // Act
        $bonus = $this->sut->get_for_location($location = 'purple');
        // Assert
        $this->assertEquals($expected_visible, $bonus);
    }

    public function test_get_from_card() {
        // Arrange
        $this->mock_cards->expects($this->exactly(1))->method('get')->willReturn([$this->default_purple_card]);
        // Act
        $visible_bonus = $this->sut->get_for_location($location = 'purple');
        // Assert
        $this->assertEquals($this->default_visible_single_card, $visible_bonus);
    }

    public function test_get_from_cards() {
        // Arrange
        $expected_visible = $this->default_visible_single_card;
        $expected_visible[4] = ['number' => 1, 'type' => '1_little_helper'];
        $expected_visible[5] = ['number' => 2, 'type' => 'stardust'];
        // Act
        $visible_bonus = $this->sut->get_from_cards([$this->higher_indentation5, $this->default_purple_card, $this->extra_purple_card], $location = 'purple');
        // Assert
        $this->assertEquals($expected_visible, $visible_bonus);
    }
}
?>
