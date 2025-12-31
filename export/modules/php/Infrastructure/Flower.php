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
 * 18 x moon lily, 15 x orbit flower, 15 x sun thistle, 12 x galaxy poppy
 */
declare(strict_types=1);

namespace Bga\Games\Gloomies\Infrastructure;

#[\AllowDynamicProperties]
class FlowerFactory {
    protected array $definitions = [];

    static public function create($deck): FlowerFactory {
        $object = new FlowerFactory();
        $object->set_deck($deck);
        return $object;
    }

    public function set_deck($deck) {
        $this->deck = $deck;
    }

    public function add($first_colour) {
        $this->definitions[] = array( 'type' => $first_colour, 'type_arg' => 0, 'nbr' => 1);
    }
    public function flush() {
        $this->deck->createCards($this->definitions);
        $this->definitions = [];
    }
}
