<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Tool;
use pocketmine\math\Vector3;
use taylordevs\SimplySickles\math\Math;
use taylordevs\SimplySickles\utils\Utils;

final class Netherite_Sickle extends Tool implements ItemComponents, Sickle {
	use ItemComponentsTrait;

	private static int $ATTACK_POINTS = 6;


	public function __construct(ItemIdentifier $identifier, string $name = "Netherite Sickles") {
		parent::__construct($identifier, $name);
		$this->initComponent("netherite_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
	}


	public function getMaxStackSize() : int {
		return 1;
	}


	public function getMaxDurability() : int {
		return 2100;
	}

	public function getAttackPoints() : int {
		return self::$ATTACK_POINTS;
	}

	public function getDamage() : int {
		return self::$ATTACK_POINTS;
	}

	public function onAttackEntity(Entity $victim) : bool {
		return $this->applyDamage(self::$ATTACK_POINTS);
	}

	public function onDestroyBlock(Block $block) : bool {
		$position = $block->getPosition();
		$world = $position->getWorld();
		$area = Math::makeSquareV2($position);
		Utils::autoRefill($block, $position, $world);
		/** @var Vector3 $pos */
		foreach ($area as $pos) {
			$block = $world->getBlock($pos);
			Utils::autoRefill($block, $pos, $world);
		}
		return true;
	}
}