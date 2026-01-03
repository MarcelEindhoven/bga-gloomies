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
class OrdersNewGame {
    const FLOWER_VALUES = ['no_flower', 'moon_lily', 'orbit_flower', 'sun_thistle', 'galaxy_poppy'];
    const ORDERS = [
        [7, [ 'moon_lily', 'moon_lily', 'sun_thistle' ]],
        [8, [ 'moon_lily', 'moon_lily', 'galaxy_poppy' ]],
        [8, [ 'moon_lily', 'sun_thistle', 'sun_thistle' ]],
        [9, [ 'orbit_flower', 'orbit_flower', 'sun_thistle' ]],
        [10, [ 'moon_lily', 'moon_lily', 'orbit_flower', 'orbit_flower' ]],
        [10, [ 'moon_lily', 'galaxy_poppy', 'galaxy_poppy' ]],
        [11, [ 'moon_lily', 'moon_lily', 'orbit_flower', 'galaxy_poppy' ]],
        [11, [ 'moon_lily', 'moon_lily', 'sun_thistle', 'galaxy_poppy' ]],
        [12, [ 'moon_lily', 'sun_thistle', 'sun_thistle', 'galaxy_poppy' ]],
        [12, [ 'orbit_flower', 'orbit_flower', 'sun_thistle', 'sun_thistle' ]],
        [13, [ 'orbit_flower', 'orbit_flower', 'sun_thistle', 'galaxy_poppy' ]],
        [13, [ 'moon_lily', 'moon_lily', 'orbit_flower', 'sun_thistle', 'sun_thistle' ]],
        [14, [ 'moon_lily', 'orbit_flower', 'orbit_flower', 'sun_thistle', 'sun_thistle' ]],
        [15, [ 'moon_lily', 'moon_lily', 'orbit_flower', 'sun_thistle', 'galaxy_poppy' ]],
        [16, [ 'moon_lily', 'orbit_flower', 'orbit_flower', 'sun_thistle', 'galaxy_poppy' ]],
        [16, [ 'orbit_flower', 'orbit_flower', 'sun_thistle', 'sun_thistle', 'galaxy_poppy' ]],
    ];

    static public function create($factory): OrdersNewGame {
        $object = new OrdersNewGame();
        $object->set_factory($factory);
        return $object;
    }

    public function set_factory($factory) : OrdersNewGame {
        $this->factory = $factory;
        return $this;
    }

    public function setup(): OrdersNewGame {
        // Create Orders
        foreach (self::ORDERS as $order) {
            $this->factory->add($order[0], $order[1]);
        }
        $this->factory->flush();

        return $this;
    }

}
