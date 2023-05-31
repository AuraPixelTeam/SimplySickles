<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\utils;

use pocketmine\block\Block;
use pocketmine\block\Crops;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wheat;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\world\World;

class Utils {
	public static function autoRefill(Block $block, Vector3 $postion, World $world) : void {
		if ($block instanceof Wheat) {
			$world->setBlock($postion, VanillaBlocks::WHEAT());
			if ($block->getAge() >= Crops::MAX_AGE) {
				$world->dropItem(new Vector3(
					$postion->getX(),
					$postion->getY(),
					$postion->getZ()),
					VanillaItems::WHEAT()
				);
			}
		}
	}
}