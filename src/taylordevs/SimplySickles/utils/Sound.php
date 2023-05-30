<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\utils;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;
use pocketmine\world\Position;

class Sound {
	public static function sendSweepSound(Player $player, Position $position) : void {
		$player->getNetworkSession()->sendDataPacket(
			PlaySoundPacket::create(
				soundName: "sickle.sweep",
				x: $position->getX(),
				y: $position->getY(),
				z: $position->getZ(),
				volume: 1.0,
				pitch: 1.0
			)
		);
	}
}