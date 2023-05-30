<?php

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

final class Diamond_Sickle extends Item implements ItemComponents
{
    use ItemComponentsTrait;
    /** @var int  */
    private static int $ATTACK_POINTS = 5;

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name = "Diamond Sickles")
    {
        parent::__construct($identifier, $name);
        $this->initComponent("diamond_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
    }

    /**
     * @return int
     */
    public function getMaxStackSize(): int
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getAttackPoints(): int
    {
        return self::$ATTACK_POINTS;
    }

    /**
     * @return int
     */
    public function getMaxDurability(): int
    {
        return 1650;
    }
}