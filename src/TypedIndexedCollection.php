<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

abstract class TypedIndexedCollection extends \ArrayObject
{
    use CollectionTrait;
    use TypedIndexedCollectionTrait;

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
