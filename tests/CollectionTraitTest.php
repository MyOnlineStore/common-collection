<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Collection;
use MyOnlineStore\Common\Collection\CollectionTrait;
use PHPUnit\Framework\TestCase;

final class CollectionTraitTest extends TestCase
{
    public function testFirstHavingWillReturnCorrectElements()
    {
        $element1 = $this->getMockBuilder(\stdClass::class)
            ->addMethods(['isFoobar'])
            ->getMock();
        $element2 = $this->getMockBuilder(\stdClass::class)
            ->addMethods(['isFoobar'])
            ->getMock();
        $element1->expects(self::once())
            ->method('isFoobar')
            ->willReturn(false);
        $element2->expects(self::once())
            ->method('isFoobar')
            ->willReturn(true);

        $extendedClass = new class([$element1, $element2]) extends Collection
        {
            public function firstHaving(callable $callback)
            {
                {
                    return parent::firstHaving($callback);
                }
            }
        };

        self::assertSame(
            $element2,
            $extendedClass->firstHaving(
                static function (\stdClass $element) {
                    return $element->isFoobar();
                }
            )
        );
    }

    public function testFirstHavingWillThrowExceptionIfNoMatchIsFound()
    {
        $element1 = $this->getMockBuilder(\stdClass::class)
            ->addMethods(['isFoobar'])
            ->getMock();
        $element2 = $this->getMockBuilder(\stdClass::class)
            ->addMethods(['isFoobar'])
            ->getMock();
        $element1->expects(self::once())
            ->method('isFoobar')
            ->willReturn(false);
        $element2->expects(self::once())
            ->method('isFoobar')
            ->willReturn(false);

        $extendedClass = new class([$element1, $element2]) extends Collection
        {
            public function firstHaving(callable $callback)
            {
                {
                    return parent::firstHaving($callback);
                }
            }
        };

        $this->expectException(\OutOfBoundsException::class);

        self::assertSame(
            $element2,
            $extendedClass->firstHaving(
                static function (\stdClass $element) {
                    return $element->isFoobar();
                }
            )
        );
    }

    public function testIsEmpty()
    {
        $collection1 = new class extends \ArrayObject
        {
            use CollectionTrait;
        };
        $collection2 = new class(['foo']) extends \ArrayObject
        {
            use CollectionTrait;
        };
        $collection3 = new class([null]) extends \ArrayObject
        {
            use CollectionTrait;
        };

        self::assertTrue($collection1->isEmpty());
        self::assertFalse($collection2->isEmpty());
        self::assertFalse($collection3->isEmpty());
    }
}
