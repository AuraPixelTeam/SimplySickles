<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wheat;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use taylordevs\SimplySickles\math\Math;

final class Iron_Sickle extends Item implements ItemComponents, Sickle {
	use ItemComponentsTrait;

	private static int $ATTACK_POINTS = 4;


	public function __construct(ItemIdentifier $identifier, string $name = "Iron Sickles") {
		parent::__construct($identifier, $name);
		$this->initComponent("iron_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
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
		return 275;
	}
	public function onDestroyBlock(Block $block) : bool {
		$position = $block->getPosition();
		$world = $position->getWorld();
		$world->setBlock($position, VanillaBlocks::WHEAT());
		$area = Math::makePlusSign($position);
		foreach ($area as $pos) {
			$block = $world->getBlock($pos);
			if ($block instanceof Wheat) {
				$world->setBlock($pos, VanillaBlocks::WHEAT());
				$world->dropItem(new Vector3($pos->getX(), $pos->getY(), $pos->getZ()), VanillaItems::WHEAT());
			}
		}
		return true;
	}
}