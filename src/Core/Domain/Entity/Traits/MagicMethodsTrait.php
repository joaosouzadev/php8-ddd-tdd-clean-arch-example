<?php

namespace Core\Domain\Entity\Traits;

use http\Exception\InvalidArgumentException;

trait MagicMethodsTrait {
    public function __get($property) {
        if (isset($this->{$property})) {
            return $this->{$property};
        }

        $className = get_class($this);
        throw new InvalidArgumentException("Property $property not found in $className");
    }

    public function getId(): string {
        return (string)$this->id;
    }
}