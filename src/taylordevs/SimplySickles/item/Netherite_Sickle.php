<?php

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

final class Netherite_Sickle extends Item implements ItemComponents
{
    use ItemComponentsTrait;
    /** @var int  */
    private static int $ATTACK_POINTS = 6;

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name = "Netherite Sickles")
    {
        parent::__construct($identifier, $name);
        $this->initComponent("netherite_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
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
        return 2100;
    }
}