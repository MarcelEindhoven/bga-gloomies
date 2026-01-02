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
class BonusTileFactory {
    protected array $definitions = [];

    static public function create($deck): BonusTileFactory {
        $object = new BonusTileFactory();
        $object->set_deck($deck);
        return $object;
    }

    public function set_deck($deck) {
        $this->deck = $deck;
    }

    public function add($purple, $turquoise) {
        $this->definitions[] = array( 'type' => $purple, 'type_arg' => $turquoise, 'nbr' => 1);
    }
    public function flush() {
        $this->deck->createCards($this->definitions);
        $this->definitions = [];
    }
}
