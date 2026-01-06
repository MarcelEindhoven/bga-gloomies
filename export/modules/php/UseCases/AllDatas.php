<?php
/**
 *------
 * BGA framework: Gregory Isabelli & Emmanuel Colin & BoardGameArena
 * Pyramido implementation : © Marcel van Nieuwenhoven marcel.eindhoven@hotmail.com
 *
 * This code has been produced on the BGA studio platform for use on http://boardgamearena.com.
 * See http://en.boardgamearena.com/#!doc/Studio for more information.
 * -----
 *
 */
declare(strict_types=1);

namespace Bga\Games\Gloomies\UseCases;

class AllDatas {
    protected array $decks = [];
    /**
     * 
     */
    static public function create($decks): AllDatas {
        $object = new AllDatas();
        $object->set_decks($decks);
        return $object;
    }

    public function set_decks($decks): AllDatas {
        $this->decks = $decks;
        return $this;
    }

    public function set_current_player_id($current_player_id): AllDatas {
        $this->current_player_id = $current_player_id;
        return $this;
    }

    /**
     * Combine results from database with calculated results from domain
     */
    public function get($players): array {
        return ["players" => $players];
    }

    protected function is_current_player_no_spectator($players) {
        return array_key_exists($this->current_player_id, $players);
    }
}
?>
