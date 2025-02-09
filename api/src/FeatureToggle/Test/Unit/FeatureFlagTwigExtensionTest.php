<?php

declare(strict_types=1);

namespace App\FeatureToggle\Test\Unit;

use App\FeatureToggle\FeatureFlag;
use App\FeatureToggle\FeatureFlagTwigExtension;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\ArrayLoader;

/**
 * @internal
 */
#[CoversClass(FeatureFlagTwigExtension::class)]
final class FeatureFlagTwigExtensionTest extends TestCase
{
    /**
     * @throws Exception
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function testActive(): void
    {
        $flag = $this->createMock(FeatureFlag::class);
        $flag->expects(self::once())->method('isEnabled')->with('ONE')->willReturn(true);
        $twig = new Environment(new ArrayLoader([
            'page.html.twig' => '<p>{{ is_feature_enabled(\'ONE\') ? \'true\' : \'false\' }}</p>',
        ]));
        $twig->addExtension(new FeatureFlagTwigExtension($flag));
        self::assertEquals('<p>true</p>', $twig->render('page.html.twig'));
    }

    /**
     * @throws SyntaxError
     * @throws Exception
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function testNotActive(): void
    {
        $flag = $this->createMock(FeatureFlag::class);
        $flag->expects(self::once())->method('isEnabled')->with('ONE')->willReturn(false);
        $twig = new Environment(new ArrayLoader([
            'page.html.twig' => '<p>{{ is_feature_enabled(\'ONE\') ? \'true\' : \'false\' }}</p>',
        ]));
        $twig->addExtension(new FeatureFlagTwigExtension($flag));
        self::assertEquals('<p>false</p>', $twig->render('page.html.twig'));
    }
}
