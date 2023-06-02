<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\Tool;
use pocketmine\math\Vector3;
use taylordevs\SimplySickles\math\Math;
use taylordevs\SimplySickles\utils\Utils;

final class Golden_Sickle extends Tool implements ItemComponents, Sickle {
	use ItemComponentsTrait;

	private static int $ATTACK_POINTS = 3;


	public function __construct(ItemIdentifier $identifier, string $name = "Golden Sickles") {
		parent::__construct($identifier, $name);
		$this->initComponent("golden_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
	}


	public function getMaxStackSize() : int {
		return 1;
	}

	public function getMaxDurability() : int {
		return 75;
	}

	public function getAttackPoints() : int {
		return self::$ATTACK_POINTS;
	}

	public function getDamage() : int {
		return self::$ATTACK_POINTS;
	}

    /**
     * @param Entity $victim
     * @param array<Item> $returnedItems
     * @return bool
     */
	public function onAttackEntity(Entity $victim, array &$returnedItems) : bool {
		return $this->applyDamage(self::$ATTACK_POINTS);
	}

    /**
     * @param Block $block
     * @param array<Item> $returnedItems
     * @return bool
     */
	public function onDestroyBlock(Block $block, array &$returnedItems) : bool {
		$position = $block->getPosition();
		$world = $position->getWorld();
		$area = Math::makeSquare($position);
		Utils::autoRefill($block, $position, $world);
        foreach ($area as $pos) {
			$block = $world->getBlock($pos);
			Utils::autoRefill($block, $pos, $world);
		}
		return true;
	}
}