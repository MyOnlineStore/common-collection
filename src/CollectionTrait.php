<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

trait CollectionTrait
{
    public function isEmpty(): bool
    {
        return 0 === \count($this);
    }

    /**
     * @return mixed
     *
     * @throws \OutOfBoundsException
     */
    protected function firstHaving(callable $callback)
    {
        foreach ($this as $element) {
            if ($callback($element)) {
                return $element;
            }
        }

        throw new \OutOfBoundsException('No entry found for the given condition');
    }
}
