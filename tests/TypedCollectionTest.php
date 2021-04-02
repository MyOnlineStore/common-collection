<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\TypedCollection;
use PHPUnit\Framework\TestCase;

final class TypedCollectionTest extends TestCase
{
    /** @var TypedCollection */
    private $collection;

    protected function setUp(): void
    {
        $this->collection = new class extends TypedCollection {
            public function isAcceptedElement($element): bool
            {
                return $element instanceof \stdClass;
            }
        };
    }

    public function testAppendWillAssertElement(): void
    {
        $element = new \stdClass;
        $this->collection->append($element);
        self::assertSame(
            $element,
            $this->collection[0]
        );

        $this->expectException(\InvalidArgumentException::class);
        $this->collection->append(true);
    }

    public function testConstructWillAssertElements(): void
    {
        self::assertInstanceOf(
            TypedCollection::class,
            new $this->collection([new \stdClass])
        );

        $this->expectException(\InvalidArgumentException::class);
        new $this->collection([true]);
    }
}
