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
 * 14 x moon lily, 12 x orbit flower, 12 x sun thistle, 8 x galaxy poppy, 14 jokers
 * Place 3 cards next to the stack
 */
declare(strict_types=1);

namespace Bga\Games\Gloomies\NewGame;

require_once("OrdersNewGame.php");

#[\AllowDynamicProperties]
class FlowerCardsNewGame {
    const FLOWER_COUNTS = [
        'moon_lily' => 14,
        'orbit_flower' => 12,
        'sun_thistle' => 12,
        'galaxy_poppy' => 8,
    ];
    const JOKER_TYPES = [[1,2], [1,2], [1,2], [1,3], [1,3], [1,3], [1,4], [1,4], [2,3], [2,3], [2,4], [2,4], [3,4], [3,4]];

    static public function create($factory): FlowerCardsNewGame {
        $object = new FlowerCardsNewGame();
        $object->set_factory($factory);
        return $object;
    }

    public function set_factory($factory) : FlowerCardsNewGame {
        $this->factory = $factory;
        return $this;
    }

    public function setup(): FlowerCardsNewGame {
        $this->create_elements();

        $this->factory->distribute(OrdersNewGame::LOCATIONS);

        return $this;
    }

    public function create_elements(): FlowerCardsNewGame {
        $this->setup_flowers();
        $this->setup_jokers();
        $this->factory->flush();

        return $this;
    }

    public function setup_flowers(): FlowerCardsNewGame {
        // Create flowers
        $type = 0;
        foreach (self::FLOWER_COUNTS as $colour => $count) {
            $type++;
            for ($i = 0; $i < $count; $i++) {
                $this->factory->add_single_type($type);
            }
        }

        return $this;
    }

    public function setup_jokers(): FlowerCardsNewGame {
        // Create jokers
        foreach (self::JOKER_TYPES as $type) {
            $this->factory->add_double_type($type[0], $type[1]);
        }

        return $this;
    }
}
