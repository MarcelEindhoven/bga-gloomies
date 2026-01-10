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
require_once("Flower.php");

#[\AllowDynamicProperties]
class FlowerCardFactory extends Factory {
    protected array $definitions = [];

    public function __construct($deck) {
        parent::__construct($deck);
    }

    public function add_single_type($first_colour) {
        $this->definitions[] = array( 'type' => $first_colour, 'type_arg' => 0, 'nbr' => 1);
    }

    public function add_double_type($first_colour, $second_colour) {
        $this->definitions[] = array( 'type' => $first_colour, 'type_arg' => $second_colour, 'nbr' => 1);
    }
}

#[\AllowDynamicProperties]
class CurrentFlowerCards {
    static public function create($deck): CurrentFlowerCards {
        $object = new CurrentFlowerCards($deck);
        return $object;
    }

    public function __construct($deck) {
        $this->set_deck($deck);
    }

    public function set_deck($deck): CurrentFlowerCards {
        $this->deck = $deck;

        return $this;
    }

    public function get($location = 'market', ?int $location_arg = null): array {
        return $this->get_from_cards($this->deck->getCardsInLocation($location, $location_arg));
    }

    public function get_from_cards(array $cards): array {
        return array_map([$this, 'get_from_card'], $cards);
    }

    public function get_from_card(array $card): array {
        return [
            'location' => $card['location'],
            'type' => Flower::FLOWER_VALUES[$card['type']],
            'joker_type' => Flower::FLOWER_VALUES[$card['type_arg']],
            'position' => +$card['location_arg']
        ];
    }
}
