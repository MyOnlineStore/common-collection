<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

// phpcs:disable
abstract class Collection extends \ArrayObject
{
    use CollectionTrait;
}
