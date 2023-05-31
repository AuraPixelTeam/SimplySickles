<?php

declare(strict_types=1);

namespace taylordevs\SimplySickles\math;

use pocketmine\math\Vector3;
use function abs;

class Math {
	/** @return array<Vector3> */
	public static function makePlusSign(Vector3 $position) : array {
		[$x, $y, $z] = [$position->getX(), $position->getY(), $position->getZ()];
		return [
			new Vector3($x, $y, $z),
			new Vector3($x + 1, $y, $z),
			new Vector3($x - 1, $y, $z),
			new Vector3($x, $y, $z + 1),
			new Vector3($x, $y, $z - 1)
		];
	}

	public static function makeSquare(Vector3 $position) : \Generator {
		[$x, $y, $z] = [$position->getX(), $position->getY(), $position->getZ()];
		$offsets = [-1, 0, 1];

		foreach ($offsets as $xOffset) {
			foreach ($offsets as $zOffset) {
				yield new Vector3($x + $xOffset, $y, $z + $zOffset);
			}
		}
	}

	public static function makeRhobus(Vector3 $position) : \Generator {
		[$x, $y, $z] = [$position->getX(), $position->getY(), $position->getZ()];
		$offsets = [-2, -1, 0, 1, 2];

		foreach ($offsets as $xOffset) {
			foreach ($offsets as $zOffset) {
				if (abs($xOffset) + abs($zOffset) <= 2) {
					yield new Vector3($x + $xOffset, $y, $z + $zOffset);
				}
			}
		}
	}

	public static function makeSquareV2(Vector3 $position) : \Generator {
		[$x, $y, $z] = [$position->getX(), $position->getY(), $position->getZ()];
		$offsets = [-2, -1, 0, 1, 2];

		foreach ($offsets as $xOffset) {
			foreach ($offsets as $zOffset) {
				if (abs($xOffset) + abs($zOffset) <= 3) {
					yield new Vector3($x + $xOffset, $y, $z + $zOffset);
				}
			}
		}
	}
}