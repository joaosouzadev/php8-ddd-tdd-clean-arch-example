<?php

namespace Core\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid {
    public function __construct(protected string $value) {
        $this->validate($value);
    }

    public static function newUuid(): self {
        return new self(RamseyUuid::uuid4()->toString());
    }

    private function validate(string $id): void {
        if (!RamseyUuid::isValid($id)) {
            throw new \InvalidArgumentException('UUID is invalid');
        }
    }

    public function __toString(): string {
        return $this->value;
    }
}