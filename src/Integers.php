<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

final class Integers extends TypedCollection
{
    /**
     * @noinspection PhpDocMissingThrowsInspection
     *
     * @param int[] $array
     */
    public static function fromArray(array $array): self
    {
        /** @noinspection PhpUnhandledExceptionInspection */

        return new self(\array_map('intval', $array));
    }

    /**
     * @param mixed $element
     */
    public function isAcceptedElement($element): bool
    {
        return \is_int($element);
    }
}
