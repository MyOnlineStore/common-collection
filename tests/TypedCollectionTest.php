<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\TypedCollection;
use PHPUnit\Framework\TestCase;

final class TypedCollectionTest extends TestCase
{
    public function testConstructWillAssertElements()
    {
        $collection = new class extends TypedCollection
        {
            public function isAcceptedElement($element): bool
            {
                return true;
            }
        };

        self::assertInstanceOf(TypedCollection::class, new $collection([$this->createMock(\stdClass::class)]));
    }
}
