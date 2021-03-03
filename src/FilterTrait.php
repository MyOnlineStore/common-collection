<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

/**
 * @method __construct(array $elements)
 * @method array getArrayCopy()
 */
trait FilterTrait
{
    /**
     * @return static
     */
    protected function filter(callable $callback)
    {
        return new static(
            \array_filter(
                $this->getArrayCopy(),
                $callback
            )
        );
    }
}
