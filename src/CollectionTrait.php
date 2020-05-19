<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

trait CollectionTrait
{
    /**
     * @return static
     * @deprecated Use \MyOnlineStore\Common\Collection\ClearTrait
     *
     */
    public function clear()
    {
        return new static();
    }

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
        foreach ($this as $entry) {
            if ($callback($entry)) {
                return $entry;
            }
        }

        throw new \OutOfBoundsException('No entry found for the given condition');
    }
}
