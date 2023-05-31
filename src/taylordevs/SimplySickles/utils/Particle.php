<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\utils;

use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;
use pocketmine\network\mcpe\protocol\types\DimensionIds;
use pocketmine\player\Player;
use pocketmine\world\Position;

class Particle {
	public static function sendSweepParticle(Player $player, Position $position) : void {
		$player->getNetworkSession()->sendDataPacket(
			SpawnParticleEffectPacket::create(
				dimensionId: DimensionIds::OVERWORLD,
				actorUniqueId: -1,
				position: $position->asVector3(),
				particleName: "sickle:sweep",
				molangVariablesJson: null
			)
		);
	}
}