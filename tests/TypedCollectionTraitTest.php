<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\TypedCollectionTrait;
use PHPUnit\Framework\TestCase;

final class TypedCollectionTraitTest extends TestCase
{
    public function testAssertArray(): void
    {
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedCollectionTrait::class)
            ->onlyMethods(['assertAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('assertAcceptedElement')
            ->with($element);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertArray([$element]);
    }

    public function testAssertAcceptedElementWillThrowExceptionOnUnacceptedElement(): void
    {
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedCollectionTrait::class)
            ->onlyMethods(['isAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('isAcceptedElement')
            ->with($element)
            ->willReturn(false);

        $this->expectException(\InvalidArgumentException::class);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertAcceptedElement($element);
    }

    public function testAssertAcceptedElementWillDoNothingOnAcceptedElement(): void
    {
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedCollectionTrait::class)
            ->onlyMethods(['isAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('isAcceptedElement')
            ->with($element)
            ->willReturn(true);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertAcceptedElement($element);
    }
}
