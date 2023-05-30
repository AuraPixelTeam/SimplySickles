<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

final class Golden_Sickle extends Item implements ItemComponents {
	use ItemComponentsTrait;

	private static int $ATTACK_POINTS = 3;


	public function __construct(ItemIdentifier $identifier, string $name = "Golden Sickles") {
		parent::__construct($identifier, $name);
		$this->initComponent("golden_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
	}


	public function getMaxStackSize() : int {
		return 1;
	}


	public function getAttackPoints() : int {
		return self::$ATTACK_POINTS;
	}

	public function getDamage() : int {
		return self::$ATTACK_POINTS;
	}
	public function getMaxDurability() : int {
		return 75;
	}

	public function onDestroyBlock(Block $block) : bool {
		// TODO: Implement sickles feature
		return true;
	}
}