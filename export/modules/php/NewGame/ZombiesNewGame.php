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

namespace Bga\Games\Gloomies\NewGame;

class ZombiesNewGame {
    static public function setup(&$players, int $number_zombieplayers): void {
        $keys = array_keys($players);
        // Assign player slots to Zombie by overwriting the player name
        for ($Zombie_index = 0; $Zombie_index < $number_zombieplayers; $Zombie_index++) {
            // Interleave human players with Zombie players
            self::skipFirstKeyIfPossible($keys, $number_zombieplayers - $Zombie_index);
            self::assignPlayerAsZombie($players[$keys[array_key_first($keys)]], $Zombie_index + 1);
            unset($keys[array_key_first($keys)]);
        }
    }
    static protected function skipFirstKeyIfPossible(& $keys, $remaining_Zombie): void {
        if ($remaining_Zombie < count($keys)) {
            // First in the remaining list is a human player
            unset($keys[array_key_first($keys)]);
        }
    }
    static protected function assignPlayerAsZombie(& $player, $Zombie_sequence_number): void {
        $player['player_name'] = 'Zombie_' . ($Zombie_sequence_number);
    }
}
