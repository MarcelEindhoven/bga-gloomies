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
class OrderFactory extends Factory {
    protected array $definitions = [];

    public function __construct($deck) {
        parent::__construct($deck);
    }

    public function add($points, $flowers) {
        $storage_value = 0;
        foreach ($flowers as $flower) {
            $storage_value = $storage_value * 10 + Flower::get_index($flower);
        }

        $this->definitions[] = array( 'type' => $storage_value, 'type_arg' => $points, 'nbr' => 1);
    }
}

#[\AllowDynamicProperties]
class CurrentOrders {
    static public function create($deck): CurrentOrders {
        $object = new CurrentOrders($deck);
        return $object;
    }

    public function __construct($deck) {
        $this->set_deck($deck);
    }

    public function set_deck($deck): CurrentOrders {
        $this->deck = $deck;

        return $this;
    }

    public function get($location = 'market'): array {
        return $this->get_from_cards($this->deck->getCardsInLocation($location));
    }

    public function get_from_cards(array $cards): array {
        return array_map([$this, 'get_from_card'], $cards);
    }

    public function get_from_card(array $card): array {
        $type_value = +$card['type'];
        $flower_types = [];
        while ($type_value > 0) {
            $flower_types[] = Flower::FLOWER_VALUES[$type_value % 10];
            $type_value = intdiv($type_value, 10);
        }
        return [
            'location' => $card['location'],
            'types' => array_reverse($flower_types),
            'points' => +$card['type_arg'],
            'position' => +$card['location_arg']
        ];
    }
}
