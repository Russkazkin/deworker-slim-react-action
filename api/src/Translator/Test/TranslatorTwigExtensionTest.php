<?php

declare(strict_types=1);

namespace App\Translator\Test;

use App\Translator\TranslatorTwigExtension;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\ArrayLoader;

/**
 * @covers \App\Translator\TranslatorTwigExtension
 *
 * @internal
 */
final class TranslatorTwigExtensionTest extends TestCase
{
    /**
     * @throws SyntaxError
     * @throws Exception
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function testActive(): void
    {
        $translator = $this->createMock(TranslatorInterface::class);
        $translator->expects(self::once())->method('trans')->with('message', [], 'domain')->willReturn('result');

        $twig = new Environment(new ArrayLoader([
            'page.html.twig' => '<p>{{ trans(\'message\', [], \'domain\') }}</p>',
        ]));

        $twig->addExtension(new TranslatorTwigExtension($translator));

        self::assertEquals('<p>result</p>', $twig->render('page.html.twig'));
    }
}
