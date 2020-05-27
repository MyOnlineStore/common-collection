<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Strings;
use PHPUnit\Framework\TestCase;

final class StringsTest extends TestCase
{
    public function testFromArray(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        self::assertEquals(new Strings(['1', '2.3', '45']), Strings::fromArray([1, 2.3, '45']));
    }

    public function testIsAcceptedElement(): void
    {
        $collection = new Strings();

        self::assertTrue($collection->isAcceptedElement('foo'));
        self::assertFalse($collection->isAcceptedElement(new \stdClass()));
    }

    public function testJoin(): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        self::assertSame('foo_bar_baz', (new Strings(['foo', 'bar', 'baz']))->join('_'));
    }
}
