<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles;

use customiesdevs\customies\item\CustomiesItemFactory;
use libCustomPack\libCustomPack;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ResourcePack;
use taylordevs\SimplySickles\item\Diamond_Sickle;
use taylordevs\SimplySickles\item\Golden_Sickle;
use taylordevs\SimplySickles\item\Iron_Sickle;
use taylordevs\SimplySickles\item\Netherite_Sickle;
use function mb_strtolower;
use function str_replace;
use function ucwords;

class SimplySickles extends PluginBase {
	private static ?ResourcePack $pack;

	protected function onEnable() : void {
		libCustomPack::registerResourcePack(self::$pack = libCustomPack::generatePackFromResources($this));

		$itemFactory = CustomiesItemFactory::getInstance();
		$namespace = mb_strtolower($this->getName() . ":");
		foreach ([
			"iron_sickle" => Iron_Sickle::class,
			"golden_sickle" => Golden_Sickle::class,
			"diamond_sickle" => Diamond_Sickle::class,
			"netherite_sickle" => Netherite_Sickle::class
		] as $name => $class) {
			$itemFactory->registerItem($class, $namespace . $name, ucwords(str_replace('_', ' ', $name)));
			$itemInstance = $itemFactory->get($namespace . $name);
			StringToItemParser::getInstance()->register($name, static fn(string $input) => $itemInstance);
		}

		$craftManager = $this->getServer()->getCraftingManager();
		foreach ([
			"iron_sickle" => VanillaItems::IRON_INGOT(),
			"golden_sickle" => VanillaItems::GOLD_INGOT(),
			"diamond_sickle" => VanillaItems::DIAMOND()
		] as $name => $item) {
			$craftManager->registerShapedRecipe(new ShapedRecipe(
				[
					' AA',
					'  A',
					'CA '
				],
				[
					'A' => $item,
					'C' => VanillaItems::STICK()
				],
				[
					'A' => $itemFactory->get($namespace . $name)
				]
			));
		}
	}

	protected function onDisable() : void {
		if (self::$pack instanceof ResourcePack) {
			libCustomPack::unregisterResourcePack(self::$pack);
		}
	}
}