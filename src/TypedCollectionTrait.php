<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

trait TypedCollectionTrait
{
    /**
     * @param mixed $element
     *
     * @throws \InvalidArgumentException
     */
    public function assertAcceptedElement($element)
    {
        if (!$this->isAcceptedElement($element)) {
            throw new \InvalidArgumentException(
                \sprintf('Collection %s does not accept element %s', static::class, \gettype($element))
            );
        }
    }

    /**
     * @noinspection PhpDocRedundantThrowsInspection
     *
     * @param mixed[] $array
     *
     * @throws \InvalidArgumentException
     */
    public function assertArray(array $array)
    {
        \array_walk($array, [$this, 'assertAcceptedElement']);
    }

    /**
     * @param mixed $element
     */
    abstract public function isAcceptedElement($element): bool;
}
