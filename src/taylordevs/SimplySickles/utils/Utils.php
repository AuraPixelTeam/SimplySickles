<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\utils;

use pocketmine\block\Beetroot;
use pocketmine\block\Block;
use pocketmine\block\Carrot;
use pocketmine\block\Crops;
use pocketmine\block\Potato;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wheat;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\world\World;
use function mt_rand;

class Utils {
	public static function autoRefill(Block $block, Vector3 $postion, World $world) : void {
		$cropTypes = [
			Wheat::class => [VanillaBlocks::WHEAT(), VanillaItems::WHEAT(), 1, 1],
			Potato::class => [VanillaBlocks::POTATOES(), VanillaItems::POTATO(), 1, 5],
			Carrot::class => [VanillaBlocks::CARROTS(), VanillaItems::CARROT(), 1, 4],
			Beetroot::class => [VanillaBlocks::BEETROOTS(), VanillaItems::BEETROOT(), 1, 1]
		];

		foreach ($cropTypes as $cropClass => [$newBlock, $item, $minCount, $maxCount]) {
			if ($block instanceof $cropClass) {
				$world->setBlock($postion, $newBlock);
				if ($block->getAge() >= Crops::MAX_AGE) {
					$count = $minCount === $maxCount ? $minCount : mt_rand($minCount, $maxCount);
					$world->dropItem(
						new Vector3($postion->getX(), $postion->getY(), $postion->getZ()),
						$item->setCount($count)
					);
				}
				break;
			}
		}
	}
}
