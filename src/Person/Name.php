<?php

namespace Tgu\Mityutyuk\Person;

class Name{
    private $firstName;
    private $lastName;

    public function __construct(
        string $firstName,
        string $lastName
)
{
    $this->lastName = $lastName;
    $this->firstName = $firstName;

}
    public function __toString(): string
    {
        return $this->firstName . ' - имя, ' . $this->lastName . ' - фамилия';
    }
    public function getFirstName():string{
        return $this->firstName;
    }
    public function getLastName():string{
        return $this->lastName;
    }
}


