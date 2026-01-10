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

namespace Bga\Games\Gloomies\Domain;

#[\AllowDynamicProperties]
class VisibleBonusTiles {
    const PURPLE_BONUS = ['stardust', '1_little_helper', '2_little_helpers', 'order_card'];
    const TURQUOISE_BONUS = ['stardust', 'moon_lily', 'orbit_flower', 'sun_thistle', 'galaxy_poppy', 'joker_flower'];

    static public function create($current): VisibleBonusTiles {
        $object = new VisibleBonusTiles($current);
        return $object;
    }

    public function __construct($current) {
        $this->set_current($current);
    }

    public function set_current($current): VisibleBonusTiles {
        $this->current = $current;

        return $this;
    }

    public function get_for_location($location = 'purple'): array {
        return $this->get_from_cards($this->current->get());
    }

    public function get_from_cards(array $cards): array {
        $highest = [0, 0, 0, 0, 0, 0, 0, 0];
        $visible = array(
            0 => ['number' => 0, 'type' => 'no_bonus'],
            1 => ['number' => 0, 'type' => 'no_bonus'],
            2 => ['number' => 0, 'type' => 'no_bonus'],
            3 => ['number' => 0, 'type' => 'no_bonus'],
            4 => ['number' => 0, 'type' => 'no_bonus'],
            5 => ['number' => 0, 'type' => 'no_bonus'],
            6 => ['number' => 0, 'type' => 'no_bonus'],
            7 => ['number' => 0, 'type' => 'no_bonus'],
        );
        foreach ($cards as $card) {
            $index = $card['indentation'];
            $visible[$index]['number'] = $visible[$index]['number'] + 1;
            if ($card['depth'] >= $highest[$index]) {
                $highest[$index] = $card['depth'];
                $visible[$index]['type'] = $card['type'];
            }
        }
        return $visible;
    }
}
