<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

trait TypedIndexedCollectionTrait
{
    use TypedCollectionTrait;

    /**
     * @throws \InvalidArgumentException
     */
    public function assertAcceptedIndex(string $index)
    {
        if (!$this->isAcceptedIndex($index)) {
            throw new \InvalidArgumentException(
                \sprintf('Index %s is not allowed in %s', $index, static::class)
            );
        }
    }

    /**
     * @param mixed[] $array
     *
     * @throws \InvalidArgumentException
     */
    public function assertArray(array $array)
    {
        foreach ($array as $index => $element) {
            // Cast to string since PHP converted numeric strings to integers
            $this->assertAcceptedIndex((string) $index);
            $this->assertAcceptedElement($element);
        }
    }

    abstract public function isAcceptedIndex(string $index): bool;
}
