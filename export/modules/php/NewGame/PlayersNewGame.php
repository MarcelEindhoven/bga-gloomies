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

#[\AllowDynamicProperties]
class PlayersNewGame {
    const HELPERS_COUNT = [1, 1, 2, 2];
    const FLOWER_CARDS_COUNT = [4, 5, 4, 5];

    protected array $nextPlayerTable = [];

    static public function create($deck): PlayersNewGame {
        $object = new PlayersNewGame();
        $object->set_deck($deck);
        return $object;
    }

    public function set_deck($deck): PlayersNewGame {
        $this->deck = $deck;
        return $this;
    }

    public function set_nextPlayerTable($nextPlayerTable): PlayersNewGame {
        $this->nextPlayerTable = $nextPlayerTable;
        return $this;
    }

    public function setup_helpers($counter): PlayersNewGame {
        foreach ($this->get_count_per_player(self::HELPERS_COUNT) as $player_id => $count) {
            $counter->set($player_id, $count);
        }

        return $this;
    }

    public function setup_flower_cards(): PlayersNewGame {
        foreach ($this->get_count_per_player(self::FLOWER_CARDS_COUNT) as $player_id => $count) {
            $this->deck->pickCards($count, 'deck', $player_id);
        }
        return $this;
    }

    public function get_count_per_player($count_per_player_order): array {
        $helpers = [];
        $first_player = $this->nextPlayerTable[0];
        $player_id = $first_player;
        $index = 0;
        do {
            $helpers[$player_id] = $count_per_player_order[$index];
            $player_id = $this->nextPlayerTable[$player_id];
            $index++;
        } while ($player_id != $first_player);

        return $helpers;
    }
}
