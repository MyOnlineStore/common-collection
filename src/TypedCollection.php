<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

abstract class TypedCollection extends \ArrayObject
{
    use CollectionTrait;
    use TypedCollectionTrait;

    /**
     * @param mixed[] $elements
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $elements = [])
    {
        $this->assertArray($elements);

        parent::__construct($elements);
    }
}
