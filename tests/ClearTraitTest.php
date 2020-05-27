<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\ClearTrait;
use PHPUnit\Framework\TestCase;

final class ClearTraitTest extends TestCase
{
    public function testClearReturnsNewInstance(): void
    {
        $collection = new class(['foo']) extends \ArrayObject {
            use ClearTrait;
        };

        $clearedCollection = $collection->clear();

        self::assertNotSame($collection, $clearedCollection);
        self::assertInstanceOf(\get_class($collection), $clearedCollection);
    }

    public function testClearRemovesItems(): void
    {
        $collection = new class(['foo']) extends \ArrayObject {
            use ClearTrait;
        };

        $clearedCollection = $collection->clear();
        \assert($clearedCollection instanceof \ArrayObject);

        self::assertNotEmpty($collection->getArrayCopy());
        self::assertEmpty($clearedCollection->getArrayCopy());
    }
}
