<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\utils;

use pocketmine\block\Block;
use pocketmine\block\Crops;
use pocketmine\block\VanillaBlocks;
use pocketmine\block\Wheat;
use pocketmine\block\Potato;
use pocketmine\block\Carrot;
use pocketmine\block\Beetroot;
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
		if ($block instanceof Potato) {
			$world->setBlock($postion, VanillaBlocks::POTATOES());
			if ($block->getAge() >= Crops::MAX_AGE) {
				$world->dropItem(new Vector3(
					$postion->getX(),
					$postion->getY(),
					$postion->getZ()),
					VanillaItems::POTATO()->setCount ($count = mt_rand(1,5))
				);
			}
		}
		if ($block instanceof Carrot) {
			$world->setBlock($postion, VanillaBlocks::CARROTS());
			if ($block->getAge() >= Crops::MAX_AGE) {
				$world->dropItem(new Vector3(
					$postion->getX(),
					$postion->getY(),
					$postion->getZ()),
					VanillaItems::CARROT()->setCount ($count = mt_rand(1,4))
				);
			}
		}
		if ($block instanceof Beetroot) {
			$world->setBlock($postion, VanillaBlocks::BEETROOTS());
			if ($block->getAge() >= Crops::MAX_AGE) {
				$world->dropItem(new Vector3(
					$postion->getX(),
					$postion->getY(),
					$postion->getZ()),
					VanillaItems::BEETROOT()
				);
			}
		}
	}
}
