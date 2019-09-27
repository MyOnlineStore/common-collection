<?php
declare(strict_types=1);

namespace MyOnlineStore\Common\Collection;

final class Strings extends TypedCollection
{
    /**
     * @noinspection PhpDocMissingThrowsInspection
     *
     * @param string[] $array
     */
    public static function fromArray(array $array): self
    {
        /** @noinspection PhpUnhandledExceptionInspection */

        return new self(\array_map('strval', $array));
    }

    /**
     * @param mixed $element
     */
    public function isAcceptedElement($element): bool
    {
        return \is_string($element);
    }

    public function join(string $glue = ''): string
    {
        return \implode($glue, $this->getArrayCopy());
    }
}
