<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Integers;
use PHPUnit\Framework\TestCase;

final class IntegersTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     */
    public function testFromArray(): void
    {
        self::assertEquals(new Integers([1, 14, 15, 16]), Integers::fromArray([true, '14', 15, 0x10]));
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function testIsAcceptedElement(): void
    {
        $collection = new Integers();

        self::assertTrue($collection->isAcceptedElement(1));
        self::assertFalse($collection->isAcceptedElement('1'));
    }
}
