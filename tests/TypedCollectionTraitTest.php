<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\TypedCollectionTrait;
use PHPUnit\Framework\TestCase;

final class TypedCollectionTraitTest extends TestCase
{
    public function testAssertArray()
    {
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedCollectionTrait::class)
            ->setMethods(['assertAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('assertAcceptedElement')
            ->with($element);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertArray([$element]);
    }

    public function testAssertAcceptedElementWillThrowExceptionOnUnacceptedElement()
    {
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedCollectionTrait::class)
            ->setMethods(['isAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('isAcceptedElement')
            ->with($element)
            ->willReturn(false);

        $this->expectException(\InvalidArgumentException::class);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertAcceptedElement($element);
    }

    public function testAssertAcceptedElementWillDoNothingOnAcceptedElement()
    {
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedCollectionTrait::class)
            ->setMethods(['isAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('isAcceptedElement')
            ->with($element)
            ->willReturn(true);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertAcceptedElement($element);
    }
}
