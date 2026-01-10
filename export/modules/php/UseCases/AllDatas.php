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

include_once(__DIR__.'/../Infrastructure/BonusTile.php');
use Bga\Games\Gloomies\Infrastructure\CurrentBonusTiles;

include_once(__DIR__.'/../Infrastructure/FlowerCard.php');
use Bga\Games\Gloomies\Infrastructure\CurrentFlowerCards;

include_once(__DIR__.'/../Infrastructure/Order.php');
use Bga\Games\Gloomies\Infrastructure\CurrentOrders;

include_once(__DIR__.'/../Domain/BonusTiles.php');
use Bga\Games\Gloomies\Domain\VisibleBonusTiles;

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

    public function set_globals($globals): AllDatas {
        $this->globals = $globals;
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
        $result = ["players" => $players];

        $result['board_rotation'] = $this->globals->get('board_rotation');
        $result['board_flip'] = $this->globals->get('board_flip');

        $result['flowers'] = $this->decks['flower']->getCardsInLocation('table');
        $result['bonus_purple'] = VisibleBonusTiles::create(CurrentBonusTiles::create($this->decks['bonus']))->get_for_location('purple');
        $result['order_market'] = CurrentOrders::create($this->decks['order_card'])->get('market');
        $result['flower_market'] = CurrentFlowerCards::create($this->decks['flower_card'])->get('market');
        $result['flower_cards_current_player'] = CurrentFlowerCards::create($this->decks['flower_card'])->get('hand', $this->current_player_id);
        return $result;
    }

    protected function is_current_player_no_spectator($players) {
        return array_key_exists($this->current_player_id, $players);
    }
}
?>
