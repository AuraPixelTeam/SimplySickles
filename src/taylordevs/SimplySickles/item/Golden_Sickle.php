<?php

namespace taylordevs\SimplySickles\item;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;

final class Golden_Sickle extends Item implements ItemComponents
{
    use ItemComponentsTrait;
    /** @var int  */
    private static int $ATTACK_POINTS = 3;

    /**
     * @param ItemIdentifier $identifier
     * @param string $name
     */
    public function __construct(ItemIdentifier $identifier, string $name = "Golden Sickles")
    {
        parent::__construct($identifier, $name);
        $this->initComponent("golden_sickle", new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_ITEMS, CreativeInventoryInfo::NONE));
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
        return 75;
    }
}