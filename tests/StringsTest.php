<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Strings;
use PHPUnit\Framework\TestCase;

final class StringsTest extends TestCase
{
    /**
     * @throws \InvalidArgumentException
     */
    public function testFromArray()
    {
        self::assertEquals(new Strings(['1', '2.3', '45']), Strings::fromArray([1, 2.3, '45']));
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function testIsAcceptedElement()
    {
        $collection = new Strings();

        self::assertTrue($collection->isAcceptedElement('foo'));
        self::assertFalse($collection->isAcceptedElement(new \stdClass()));
    }
}
