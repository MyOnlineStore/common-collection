<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

trait ClearTrait
{
    /**
     * @return static
     */
    public function clear()
    {
        return new static();
    }
}
