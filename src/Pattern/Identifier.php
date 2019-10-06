<?php

namespace RevealPhp\Pattern;

class Identifier
{
    use PrivateConstructor;

    public static function fromString(string $class, $firstIdentifier, ...$identifiers): self
    {
        $args = implode(',', $identifiers);

        $identifier = new self();
        $identifier->stringId = md5("$class($firstIdentifier,$args)");

        return $identifier;
    }

    public static function fromIdentifiable(string $class, Identifiable $firstIdentifiable, Identifiable ...$identifiables): self
    {
        $args = implode(',', array_map(
            function (Identifiable $identifiable): string {
                return $identifiable->identifier()->toString();
            },
            $identifiables
        ));

        $identifier = new self();
        $identifier->stringId = md5("$class({$firstIdentifiable->identifier()->toString()},$args)");

        return $identifier;
    }

    public function equals(self $identifier): bool
    {
        return $this->stringId === $identifier->stringId;
    }

    public function toString(): string
    {
        return $this->stringId;
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    /** @var string */
    private $stringId;
}
