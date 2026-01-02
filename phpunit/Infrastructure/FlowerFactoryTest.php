<?php
namespace Bga\Games\Gloomies\Infrastructure;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/Infrastructure/Flower.php');

include_once(__DIR__.'/../../_ide_helper.php');
use \Bga\GameFramework\Components\Deck;

class FlowerFactoryTest extends TestCase{
    protected ?FlowerFactory $sut = null;
    protected ?Deck $mock_cards = null;

    public function setup(): void {
        $this->mock_cards = $this->createMock(Deck::class);
        $this->sut = FlowerFactory::create($this->mock_cards);
    }

    public function test_flush_with_empty_definition() {
        // Arrange
        $expected_location = 'deck1';
        $this->mock_cards->expects($this->exactly(1))->method('createCards')->with([], $expected_location);
        // Act
        $this->sut->flush($expected_location);
        // Assert
    }

    public function test_flush_with_single_definition() {
        // Arrange
        $colour = 1;
        $expected_definition = array( 'type' => $colour, 'type_arg' => 0, 'nbr' => 1);
        $expected_location = 'deck1';
        $this->mock_cards->expects($this->exactly(1))->method('createCards')->with([$expected_definition], $expected_location);

        // Act
        $this->sut->add($colour);
        $this->sut->flush($expected_location);
        // Assert
    }
}
?>
