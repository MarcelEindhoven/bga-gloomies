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
require_once("FlowerCardsNewGame.php");
require_once("BonusTilesNewGame.php");
require_once("OrdersNewGame.php");
require_once("ZombiesNewGame.php");
require_once("PlayersNewGame.php");

include_once(__DIR__.'/../Infrastructure/Flower.php');
include_once(__DIR__.'/../Infrastructure/FlowerCard.php');
include_once(__DIR__.'/../Infrastructure/BonusTile.php');
include_once(__DIR__.'/../Infrastructure/Order.php');

use Bga\Games\Gloomies\Infrastructure\FlowerCardFactory;
use Bga\Games\Gloomies\Infrastructure\FlowerFactory;
use Bga\Games\Gloomies\Infrastructure\OrderFactory;
use Bga\Games\Gloomies\Infrastructure\BonusTileFactory;

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
        $this->order = OrdersNewGame::create(OrderFactory::create($this->decks['order_card']));
        $this->bonus = BonusTilesNewGame::create(BonusTileFactory::create($this->decks['bonus']));
        return $this;
    }

    public function setup_components() : NewGame {
        $this->flowers->setup();
        $this->flower_cards->setup();
        $this->order->setup();
        $this->bonus->setup();
        return $this;
    }

    public function setup_players($nextPlayerTable, $player_helpers): NewGame {
        PlayersNewGame::create($this->decks['flower_card'])
            ->set_nextPlayerTable($nextPlayerTable)
            ->setup_helpers($player_helpers);
        return $this;
    }

    public function setup_zombies(&$players, int $number_zombieplayers): NewGame {
        ZombiesNewGame::setup($players, $number_zombieplayers);

        return $this;
    }
}
