<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\listener;

use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use taylordevs\SimplySickles\item\Sickle;
use taylordevs\SimplySickles\utils\Particle;
use taylordevs\SimplySickles\utils\Sound;

class EventListener implements Listener {
	public function onBreakBlock(BlockBreakEvent $event) : void {
		$item = $event->getItem();
		if ($item instanceof Sickle) {
			Sound::sendSweepSound($event->getPlayer(), $event->getBlock()->getPosition());
			Particle::sendSweepParticle($event->getPlayer(), $event->getBlock()->getPosition());
		}
	}
}