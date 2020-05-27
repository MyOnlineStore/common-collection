<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\ClearTrait;
use PHPUnit\Framework\TestCase;

final class ClearTraitTest extends TestCase
{
    public function testClearRemovesItems(): void
    {
        $collection = $this->createCollection(['foo']);
        $clearedCollection = $collection->clear();
        \assert($clearedCollection instanceof \ArrayObject);

        self::assertNotEmpty($collection->getArrayCopy());
        self::assertEmpty($clearedCollection->getArrayCopy());
    }

    public function testClearReturnsNewInstance(): void
    {
        $collection = $this->createCollection(['foo']);
        $clearedCollection = $collection->clear();

        self::assertNotSame($collection, $clearedCollection);
        self::assertInstanceOf(\get_class($collection), $clearedCollection);
    }

    /**
     * @param string[] $elements
     */
    protected function createCollection(array $elements): \ArrayObject
    {
        // phpcs:disable
        return new class($elements) extends \ArrayObject {
            use ClearTrait;
        };
        // phpcs:enable
    }
}
