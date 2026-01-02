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

#[\AllowDynamicProperties]
class FlowerCardFactory {
    protected array $definitions = [];

    static public function create($deck): FlowerCardFactory {
        $object = new FlowerCardFactory();
        $object->set_deck($deck);
        return $object;
    }

    public function set_deck($deck) {
        $this->deck = $deck;
    }

    public function add_single_type($first_colour) {
        $this->definitions[] = array( 'type' => $first_colour, 'type_arg' => 0, 'nbr' => 1);
    }

    public function add_double_type($first_colour, $second_colour) {
        $this->definitions[] = array( 'type' => $first_colour, 'type_arg' => $second_colour, 'nbr' => 1);
    }

    public function flush() {
        $this->deck->createCards($this->definitions);
        $this->definitions = [];
    }
}
