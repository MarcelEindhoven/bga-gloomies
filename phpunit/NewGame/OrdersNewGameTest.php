<?php
namespace Bga\Games\Gloomies\NewGame;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/NewGame/OrdersNewGame.php');

include_once(__DIR__.'/../../export/modules/php/Infrastructure/Order.php');
use Bga\Games\Gloomies\Infrastructure\OrderFactory;

include_once(__DIR__.'/../../_ide_helper.php');

class OrdersNewGameTest extends TestCase{
    protected ?OrdersNewGame $sut = null;
    protected ?OrderFactory $mock_factory = null;

    public function setup(): void {
        $this->mock_factory = $this->createMock(OrderFactory::class);
        $this->sut = OrdersNewGame::create($this->mock_factory);
    }

    /**
     */
    public function test_Order_creation() {
        // Arrange
        $this->mock_factory->expects($this->exactly(1))->method('flush');
        $this->mock_factory->expects($this->exactly(16))->method('add');
        // Act
        $this->sut->setup();
        // Assert
    }
}
?>
