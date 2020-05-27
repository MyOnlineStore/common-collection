<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Collection;
use MyOnlineStore\Common\Collection\CollectionTrait;
use PHPUnit\Framework\TestCase;

final class CollectionTraitTest extends TestCase
{
    public function testFirstHavingWillReturnCorrectElements(): void
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

        $collection = $this->createCollection([$element1, $element2]);

        self::assertSame(
            $element2,
            $collection->firstHaving(
                static function (\stdClass $element): bool {
                    return $element->isFoobar();
                }
            )
        );
    }

    public function testFirstHavingWillThrowExceptionIfNoMatchIsFound(): void
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

        $collection = $this->createCollection([$element1, $element2]);

        $this->expectException(\OutOfBoundsException::class);

        self::assertSame(
            $element2,
            $collection->firstHaving(
                static function (\stdClass $element): bool {
                    return $element->isFoobar();
                }
            )
        );
    }

    public function testIsEmpty(): void
    {
        // phpcs:disable
        $collection1 = new class extends \ArrayObject {
            use CollectionTrait;
        };
        $collection2 = new class(['foo']) extends \ArrayObject {
            use CollectionTrait;
        };
        $collection3 = new class([null]) extends \ArrayObject {
            use CollectionTrait;
        };
        // phpcs:enable

        self::assertTrue($collection1->isEmpty());
        self::assertFalse($collection2->isEmpty());
        self::assertFalse($collection3->isEmpty());
    }

    /**
     * @param \stdClass[] $elements
     */
    protected function createCollection(array $elements): Collection
    {
        // phpcs:disable
        return new class($elements) extends Collection {
            public function firstHaving(callable $callback): \stdClass
            {
                {
                    return parent::firstHaving($callback);
                }
            }
        };
        // phpcs:enable
    }
}
