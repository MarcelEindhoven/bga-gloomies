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

namespace Bga\Games\Gloomies\Infrastructure;

require_once("Factory.php");

#[\AllowDynamicProperties]
class BonusTileFactory extends Factory {
    protected array $definitions = [];

    public function __construct($deck) {
        parent::__construct($deck);
    }

    public function add($purple, $turquoise) {
        $this->definitions[] = array( 'type' => array_search($purple, CurrentBonusTiles::PURPLE_BONUS), 'type_arg' => array_search($turquoise, CurrentBonusTiles::TURQUOISE_BONUS), 'nbr' => 1);
    }
}

#[\AllowDynamicProperties]
class CurrentBonusTiles {
    const PURPLE_BONUS = ['stardust', '1 little_helper', '2 little_helpers', 'order_card'];
    const TURQUOISE_BONUS = ['stardust', 'moon_lily', 'orbit_flower', 'sun_thistle', 'galaxy_poppy', 'joker_flower'];

    static public function create($deck): CurrentBonusTiles {
        $object = new CurrentBonusTiles($deck);
        return $object;
    }

    public function __construct($deck) {
        $this->set_deck($deck);
    }

    public function set_deck($deck): CurrentBonusTiles {
        $this->deck = $deck;

        return $this;
    }

    public function get(): array {
        return $this->get_from_cards($this->deck->getCardsInLocation('purple'));
    }

    public function get_from_cards(array $cards): array {
        return array_map([$this, 'get_from_card'], $cards);
    }

    public function get_from_card(array $card): array {
        return [
            'location' => $card['location'],
            'type' => CurrentBonusTiles::PURPLE_BONUS[$card['type']],
            'indentation' => intdiv(+$card['location_arg'], 10),
            'depth' => +$card['location_arg'] % 10
        ];
    }
}
