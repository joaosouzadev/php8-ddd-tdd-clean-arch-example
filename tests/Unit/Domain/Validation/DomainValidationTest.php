<?php

namespace Tests\Unit\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use PHPUnit\Framework\TestCase;

class DomainValidationTest extends TestCase {
    public function test_valueNotEmpty() {
        try {
            $value = "";
            DomainValidation::notEmpty($value);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function test_valueNotEmpty_CustomMessageException() {
        try {
            $value = "";
            DomainValidation::notEmpty($value, "custom message");
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
            $this->assertEquals($th->getMessage(), "custom message");
        }
    }

    public function test_stringMinLength() {
        try {
            $value = "asdf";
            DomainValidation::minLength($value, 5);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function test_stringMaxLength() {
        try {
            $value = "qwerty";
            DomainValidation::maxLength($value, 5);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }

    public function test_positiveNumber() {
        try {
            $value = 0;
            DomainValidation::positiveNumber($value);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}