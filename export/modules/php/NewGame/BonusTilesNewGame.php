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
 * Purple bonus tiles are stardust, 1 or 2 little helpers, order
 * Turquoise bonus tiles are: stardust, bonus flower or joke flower
 * Bonus flower is moon lily, orbit flower, sun thistle, galaxy poppy
 */
declare(strict_types=1);

namespace Bga\Games\Gloomies\NewGame;

#[\AllowDynamicProperties]
class BonusTilesNewGame {
    const PURPLE_BONUS = ['stardust', '1 little_helper', '2 little_helpers', 'order_card'];
    const TURQUOISE_BONUS = ['stardust', 'moon_lily', 'orbit_flower', 'sun_thistle', 'galaxy_poppy', 'joker_flower'];
    const BONUS_TILES = [
        [ 'stardust', 'stardust' ], // 1
        [ 'stardust', 'moon_lily' ], // 2
        [ 'stardust', 'orbit_flower' ], // 3
        [ 'stardust', 'sun_thistle' ], // 4
        [ 'stardust', 'galaxy_poppy' ], // 5
        [ 'stardust', 'joker_flower' ], // 6
        [ '1 little_helper', 'stardust' ], // 7
        [ '1 little_helper', 'moon_lily' ], // 8
        [ '1 little_helper', 'orbit_flower' ], // 9
        [ '1 little_helper', 'galaxy_poppy' ], // 11
        [ '2 little_helpers', 'stardust' ], // 13
        [ '2 little_helpers', 'sun_thistle' ], // 16
        [ '2 little_helpers', 'galaxy_poppy' ], // 17
        [ '2 little_helpers', 'joker_flower' ], // 18
        [ 'order_card', 'stardust' ], // 19
        [ 'order_card', 'stardust' ], // 19
        [ 'order_card', 'stardust' ], // 19
        [ 'order_card', 'moon_lily' ], // 20
        [ 'order_card', 'moon_lily' ], // 20
        [ 'order_card', 'orbit_flower' ], // 21
        [ 'order_card', 'orbit_flower' ], // 21
        [ 'order_card', 'sun_thistle' ], // 22
        [ 'order_card', 'sun_thistle' ], // 22
        [ 'order_card', 'joker_flower' ], // 24
    ];

    static public function create($factory): BonusTilesNewGame {
        $object = new BonusTilesNewGame();
        $object->set_factory($factory);
        return $object;
    }

    public function set_factory($factory) : BonusTilesNewGame {
        $this->factory = $factory;
        return $this;
    }

    public function setup(): BonusTilesNewGame {
        $this->create_elements();

        $this->factory->distribute($this->get_locations());

        return $this;
    }
    public function create_elements(): BonusTilesNewGame {
        // Create BonusTiles
        foreach (self::BONUS_TILES as $tile) {
            $this->factory->add($tile[0], $tile[1]);
        }
        $this->factory->flush();

        return $this;
    }

    public function get_locations(): array {
        $locations = [];
        for ($indentation = 0; $indentation < 8; $indentation++) {
            for ($i = 0; $i < 3; $i++) {
                $locations[] = ['deck', 'purple', 10 * $indentation + $i];
            }
        }
        return $locations;
    }

}
