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

namespace Bga\Games\Gloomies\NewGame;

#[\AllowDynamicProperties]
class FlowersNewGame {
    static public function create($factory): FlowersNewGame {
        $object = new FlowersNewGame();
        $object->set_factory($factory);
        return $object;
    }

    public function set_factory($factory) : FlowersNewGame {
        $this->factory = $factory;
        return $this;
    }
}
