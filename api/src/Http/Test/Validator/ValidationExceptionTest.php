<?php

declare(strict_types=1);

namespace App\Http\Test\Validator;

use App\Http\Validator\ValidationException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolationList;

/**
 * @internal
 */
#[CoversClass(ValidationException::class)]
#[UsesClass(ValidationExceptionTest::class)]
final class ValidationExceptionTest extends TestCase
{
    public function testValid(): void
    {
        $exception = new ValidationException(
            $violations = new ConstraintViolationList()
        );

        self::assertEquals('Invalid input.', $exception->getMessage());
        self::assertEquals($violations, $exception->getViolations());
    }
}
