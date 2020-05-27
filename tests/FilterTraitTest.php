<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection\Tests;

use MyOnlineStore\Common\Collection\Collection;
use MyOnlineStore\Common\Collection\FilterTrait;
use PHPUnit\Framework\TestCase;

final class FilterTraitTest extends TestCase
{
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
            ->willReturn(true);

        $collection = new class([$element1, $element2]) extends Collection {
            use FilterTrait;

            public function filterOnlyFoobar(): self
            {
                return $this->filter(
                    static function (\stdClass $stdClass): bool {
                        return !$stdClass->isFooBar();
                    }
                );
            }
        };

        self::assertEquals(
            new $collection([$element2]),
            $collection->filterOnlyFoobar()
        );
    }
}
