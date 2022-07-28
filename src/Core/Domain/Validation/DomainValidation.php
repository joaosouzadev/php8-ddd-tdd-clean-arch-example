<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation {
    const DEFAULT_NOT_EMPTY_EXCEPTION_MESSAGE = "Input cannot be null";
    const DEFAULT_MIN_LENGTH_EXCEPTION_MESSAGE = "Input must be at least : characters long";
    const DEFAULT_MAX_LENGTH_EXCEPTION_MESSAGE = "Input must be at maximum : characters long";
    const DEFAULT_POSITIVE_NUMBER_EXCEPTION_MESSAGE = "Input must be a positive number";

    public static function notEmpty(string $value, string $customExceptionMessage = null): void {
        if (empty($value)) {
            throw new EntityValidationException($customExceptionMessage ?? self::DEFAULT_NOT_EMPTY_EXCEPTION_MESSAGE);
        }
    }

    public static function minLength(string $value, int $length, string $customExceptionMessage = null): void {
        if (strlen($value) < $length) {
            throw new EntityValidationException($customExceptionMessage ?? str_replace(self::DEFAULT_MIN_LENGTH_EXCEPTION_MESSAGE, ":", $length));
        }
    }

    public static function maxLength(string $value, int $length, string $customExceptionMessage = null): void {
        if (strlen($value) > $length) {
            throw new EntityValidationException($customExceptionMessage ?? str_replace(self::DEFAULT_MAX_LENGTH_EXCEPTION_MESSAGE, ":", $length));
        }
    }

    public static function positiveNumber(string $value, string $customExceptionMessage = null): void {
        if ($value <= 0) {
            throw new EntityValidationException($customExceptionMessage ?? self::DEFAULT_POSITIVE_NUMBER_EXCEPTION_MESSAGE);
        }
    }
}