<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\TypedIndexedCollection;
use PHPUnit\Framework\TestCase;

final class TypedIndexedCollectionTest extends TestCase
{
    public function testConstructWillAssertElementsAndIndices(): void
    {
        // phpcs:disable
        $collection = new class extends TypedIndexedCollection {
            public function isAcceptedElement($element): bool
            {
                return true;
            }

            public function isAcceptedIndex(string $index): bool
            {
                return true;
            }
        };
        // phpcs:enable

        self::assertInstanceOf(
            TypedIndexedCollection::class,
            new $collection([$this->createMock(\stdClass::class)])
        );
    }
}
