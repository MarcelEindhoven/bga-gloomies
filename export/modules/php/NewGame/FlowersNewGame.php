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
    const FLOWER_COUNTS = [
        'moon_lily' => 18,
        'orbit_flower' => 15,
        'sun_thistle' => 15,
        'galaxy_poppy' => 12,
    ];
    static public function create($factory): FlowersNewGame {
        $object = new FlowersNewGame();
        $object->set_factory($factory);
        return $object;
    }

    public function set_factory($factory) : FlowersNewGame {
        $this->factory = $factory;
        return $this;
    }
    public function setup(): FlowersNewGame {
        // Create flowers
        $type = 0;
        foreach (self::FLOWER_COUNTS as $colour => $count) {
            $type++;
            for ($i = 0; $i < $count; $i++) {
                $this->factory->add($type);
            }
            $this->factory->flush('deck' . $type);
        }

        return $this;
    }
}
