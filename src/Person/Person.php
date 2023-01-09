<?php

namespace Tgu\Mityutyuk\Person;

use DateTimeImmutable;

class Person
{
    private $name;
    private $registeredOn;

    public function __construct(
        Name $name,
        DateTimeImmutable $registeredOn
    )
    {
        $this->registeredOn = $registeredOn;
        $this->name = $name;

    }

    public function __toString(): string
    {
        return $this->name . ' на сайте с ' . $this->registeredOn->format('Y-m-d');
    }
}