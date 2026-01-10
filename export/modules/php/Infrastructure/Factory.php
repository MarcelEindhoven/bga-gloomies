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
 * Child class should fill definitions array and call flush to create cards in deck
 */
declare(strict_types=1);

namespace Bga\Games\Gloomies\Infrastructure;

#[\AllowDynamicProperties]
class Factory {
    protected array $definitions = [];

    public function __construct($deck) {
        $this->set_deck($deck);
    }

    public function set_deck($deck) {
        $this->deck = $deck;
    }

    public function flush($location = 'deck'): void {
        $this->deck->createCards($this->definitions, $location);
        $this->deck->shuffle($location);

        $this->definitions = [];
    }

    public function distribute($locations): void {
        foreach ($locations as $location) {
            $this->deck->pickCardForLocation($location[0], $location[1], $location[2]);
        }
    }

    public function pick_cards($players): void {
        foreach ($players as $player) {
            $expected_location = $player['id'] === null ? 'market' : $player['id'];
            $this->deck->pickCardsForLocation($player['initial_number_cards'], 'deck', $expected_location);
        }
    }
}
