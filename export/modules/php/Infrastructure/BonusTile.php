<?php
/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * Gloomies implementation : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 */
declare(strict_types=1);

namespace Bga\Games\Gloomies\Infrastructure;

require_once("Factory.php");

#[\AllowDynamicProperties]
class BonusTileFactory extends Factory {
    protected array $definitions = [];

    public function __construct($deck) {
        parent::__construct($deck);
    }

    public function add($purple, $turquoise) {
        $this->definitions[] = array( 'type' => $purple, 'type_arg' => $turquoise, 'nbr' => 1);
    }
}
