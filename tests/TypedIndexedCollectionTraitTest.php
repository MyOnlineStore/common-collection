<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\TypedIndexedCollectionTrait;
use PHPUnit\Framework\TestCase;

final class TypedIndexedCollectionTraitTest extends TestCase
{
    public function testAssertArray()
    {
        $index = 'foo';
        $element = new \stdClass();

        $typedCollection = $this->getMockBuilder(TypedIndexedCollectionTrait::class)
            ->setMethods(['assertAcceptedIndex', 'assertAcceptedElement'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('assertAcceptedIndex')
            ->with($index);

        $typedCollection->expects(self::once())
            ->method('assertAcceptedElement')
            ->with($element);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertArray([$index => $element]);
    }

    public function testAssertAcceptedIndexWillThrowExceptionOnUnacceptedElement()
    {
        $index = 'foo';

        $typedCollection = $this->getMockBuilder(TypedIndexedCollectionTrait::class)
            ->setMethods(['isAcceptedIndex'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('isAcceptedIndex')
            ->with($index)
            ->willReturn(false);

        $this->expectException(\InvalidArgumentException::class);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertAcceptedIndex($index);
    }

    public function testAssertAcceptedIndexWillDoNothingOnAcceptedElement()
    {
        $index = 'foo';

        $typedCollection = $this->getMockBuilder(TypedIndexedCollectionTrait::class)
            ->setMethods(['isAcceptedIndex'])
            ->getMockForTrait();

        $typedCollection->expects(self::once())
            ->method('isAcceptedIndex')
            ->with($index)
            ->willReturn(true);

        /** @noinspection PhpUndefinedMethodInspection */
        $typedCollection->assertAcceptedIndex($index);
    }
}
