<?php

declare(strict_types=1);

namespace App\FeatureToggle\Test\Unit;

use App\FeatureToggle\Features;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Features::class)]
class FeaturesTest extends TestCase
{
    public function testInitial(): void
    {
        $features = new Features();
        self::assertFalse($features->isEnabled('FIRST'));
    }
}
