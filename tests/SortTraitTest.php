<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Collection;
use MyOnlineStore\Common\Collection\SortTrait;
use PHPUnit\Framework\TestCase;

final class SortTraitTest extends TestCase
{
    public function testFirstHavingWillThrowExceptionIfNoMatchIsFound(): void
    {
        $collection = new class([3, 1, 2]) extends Collection {
            use SortTrait;

            public function sortByNumber(): self
            {
                return $this->sort(
                    static function (int $first, int $second): int {
                        return $first <=> $second;
                    }
                );
            }
        };

        self::assertEquals(
            new $collection([1, 2, 3]),
            $collection->sortByNumber()
        );
    }
}
