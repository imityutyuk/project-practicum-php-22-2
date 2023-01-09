<?php

namespace Tgu\Mityutyuk\Person;

class Name{
    private $idUser;
    private $firstName;
    private $lastName;

    public function __construct(
        int $idUser,
        string $firstName,
        string $lastName
)
{
    $this->lastName = $lastName;
    $this->firstName = $firstName;
    $this->idUser = $idUser;

}
    public function __toString(): string
    {
        return $this->idUser . ' ' .$this->firstName . ' ' . $this->lastName;
    }
}


