<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

/**
 * @method __construct(array $elements)
 * @method array getArrayCopy()
 */
trait SortTrait
{
    /**
     * @return static
     */
    protected function sort(callable $callback)
    {
        $elements = $this->getArrayCopy();
        \usort($elements, $callback);

        return new static($elements);
    }
}
