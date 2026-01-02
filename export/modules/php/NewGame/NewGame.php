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

require_once("FlowersNewGame.php");

include_once(__DIR__.'/../Infrastructure/Flower.php');
include_once(__DIR__.'/../Infrastructure/FlowerCard.php');
use Bga\Games\Gloomies\Infrastructure\FlowerCardFactory;
use Bga\Games\Gloomies\Infrastructure\FlowerFactory;

#[\AllowDynamicProperties]
class NewGame {
    protected array $decks = [];

    static public function create($decks): NewGame {
        $object = new NewGame();
        $object->set_decks($decks);
        return $object;
    }

    public function set_decks($decks) : NewGame {
        $this->decks = $decks;
        $this->flowers = FlowersNewGame::create(FlowerFactory::create($this->decks['flower']));
        $this->flower_cards = FlowerCardsNewGame::create(FlowerCardFactory::create($this->decks['flower_card']));
        return $this;
    }

    public function setup_components() : NewGame {
        $this->flowers->setup();
        $this->flower_cards->setup();
        return $this;
    }

    public function setup_zombies(&$players, int $number_zombieplayers): NewGame {
        $keys = array_keys($players);
        // Assign player slots to Zombie by overwriting the player name
        for ($Zombie_index = 0; $Zombie_index < $number_zombieplayers; $Zombie_index++) {
            // Interleave human players with Zombie players
            $this->skipFirstKeyIfPossible($keys, $number_zombieplayers - $Zombie_index);
            $this->assignPlayerAsZombie($players[$keys[array_key_first($keys)]], $Zombie_index + 1);
            unset($keys[array_key_first($keys)]);
        }

        return $this;
    }
    protected function skipFirstKeyIfPossible(& $keys, $remaining_Zombie) {
        if ($remaining_Zombie < count($keys)) {
            // First in the remaining list is a human player
            unset($keys[array_key_first($keys)]);
        }
    }
    protected function assignPlayerAsZombie(& $player, $Zombie_sequence_number) {
        $player['player_name'] = 'Zombie_' . ($Zombie_sequence_number);
    }
}
