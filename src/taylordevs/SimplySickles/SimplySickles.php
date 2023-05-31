<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles;

use customiesdevs\customies\item\CustomiesItemFactory;
use libCustomPack\libCustomPack;
use pocketmine\crafting\ShapedRecipe;
use pocketmine\crafting\ShapelessRecipe;
use pocketmine\inventory\CreativeInventory;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\StringToItemParser;
use pocketmine\item\VanillaItems;
use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ResourcePack;
use taylordevs\SimplySickles\item\Diamond_Sickle;
use taylordevs\SimplySickles\item\Golden_Sickle;
use taylordevs\SimplySickles\item\Iron_Sickle;
use taylordevs\SimplySickles\item\Netherite_Sickle;
use taylordevs\SimplySickles\listener\EventListener;
use function mb_strtolower;
use function str_replace;
use function ucwords;

class SimplySickles extends PluginBase {
	private static ?ResourcePack $pack;

	const NETHERITE_INGOT_ID = 742;

	protected function onEnable() : void {
		libCustomPack::registerResourcePack(self::$pack = libCustomPack::generatePackFromResources($this));
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);

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
		ItemFactory::getInstance()->register(new Item(new ItemIdentifier(self::NETHERITE_INGOT_ID, 0), 'Netherite Ingot'));
		StringToItemParser::getInstance()->register('netherite_ingot', fn(string $input) => ItemFactory::getInstance()->get(self::NETHERITE_INGOT_ID));
		CreativeInventory::getInstance()->add(ItemFactory::getInstance()->get(self::NETHERITE_INGOT_ID));
		$craftManager->registerShapelessRecipe(new ShapelessRecipe([$itemFactory->get($namespace . "diamond_sickle"), ItemFactory::getInstance()->get(self::NETHERITE_INGOT_ID)], [$itemFactory->get($namespace . "netherite_sickle")]));
	}

	protected function onDisable() : void {
		if (self::$pack instanceof ResourcePack) {
			libCustomPack::unregisterResourcePack(self::$pack);
		}
	}
}