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
    const PURPLE_BONUS = ['stardust', '1 little_helper', '2 little_helpers', 'order'];
    const TURQUOISE_BONUS = ['stardust', 'moon lily', 'orbit flower', 'sun thistle', 'galaxy poppy', 'joker_flower'];
    const BONUS_TILES = [
        [ 'stardust', 'stardust' ], // 1
        [ 'stardust', 'moon lily' ], // 2
        [ 'stardust', 'orbit flower' ], // 3
        [ 'stardust', 'sun thistle' ], // 4
        [ 'stardust', 'galaxy poppy' ], // 5
        [ 'stardust', 'joker_flower' ], // 6
        [ '1 little_helper', 'stardust' ], // 7
        [ '1 little_helper', 'moon lily' ], // 8
        [ '1 little_helper', 'orbit flower' ], // 9
        [ '1 little_helper', 'galaxy poppy' ], // 11
        [ '2 little_helpers', 'stardust' ], // 13
        [ '2 little_helpers', 'sun thistle' ], // 16
        [ '2 little_helpers', 'galaxy poppy' ], // 17
        [ '2 little_helpers', 'joker_flower' ], // 18
        [ 'order', 'stardust' ], // 19
        [ 'order', 'stardust' ], // 19
        [ 'order', 'stardust' ], // 19
        [ 'order', 'moon lily' ], // 20
        [ 'order', 'moon lily' ], // 20
        [ 'order', 'orbit flower' ], // 21
        [ 'order', 'orbit flower' ], // 21
        [ 'order', 'sun thistle' ], // 22
        [ 'order', 'sun thistle' ], // 22
        [ 'order', 'joker_flower' ], // 24
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
        // Create BonusTiles
        foreach (self::BONUS_TILES as $tile) {
            $this->factory->add(array_search($tile[0], self::PURPLE_BONUS), array_search($tile[1], self::TURQUOISE_BONUS));
        }
        $this->factory->flush();

        return $this;
    }
}
