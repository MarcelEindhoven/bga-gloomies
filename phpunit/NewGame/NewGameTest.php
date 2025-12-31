<?php
namespace Bga\Games\Gloomies\NewGame;
/**
 *------
 * Gloomies implementation unit tests : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 */

include_once(__DIR__.'/../../vendor/autoload.php');
use PHPUnit\Framework\TestCase;

include_once(__DIR__.'/../../export/modules/php/NewGame/NewGame.php');

include_once(__DIR__.'/../../_ide_helper.php');
use Bga\Games\FrameworkInterfaces;

class NewGameTest extends TestCase{
    protected ?NewGame $sut = null;

    public function setup(): void {
    }

    /**
     */
    public function test_integration_domino_creation() {
        // Arrange
        // Act
        // Assert
    }
}
?>
