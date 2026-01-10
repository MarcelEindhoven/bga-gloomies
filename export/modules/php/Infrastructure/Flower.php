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
class FlowerFactory extends Factory {
    protected array $definitions = [];

    public function __construct($deck) {
        parent::__construct($deck);
    }

    public function add($first_colour) {
        $this->definitions[] = array( 'type' => $first_colour, 'type_arg' => 0, 'nbr' => 1);
    }
}
#[\AllowDynamicProperties]
class Flower {
    const FLOWER_VALUES = ['no_flower', 'moon_lily', 'orbit_flower', 'sun_thistle', 'galaxy_poppy'];
}

#[\AllowDynamicProperties]
class CurrentFlowers {

    static public function create($deck): CurrentFlowers {
        $object = new CurrentFlowers();
        $object->set_deck($deck);
        return $object;
    }

    public function set_deck($deck): CurrentFlowers {
        $this->deck = $deck;

        return $this;
    }
    public function get_on_board(): array {
        return $this->deck->getCardsInLocation('board');
    }
}
