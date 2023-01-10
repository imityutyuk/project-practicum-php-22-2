<?php

namespace Tgu\Mityutyuk\Blog;

use Tgu\Mityutyuk\Person\Name;

class User
{
    public function __construct(
        private UUID $uuid,
        private Name $name,
        private string $username,
    )
    {
    }
    public function __toString(): string
    {
        $uuid=$this->getByUuid();
        $firstName = $this->name->getFirstName();
        $lastName = $this->name->getLastName();
        return "User $uuid with name $firstName $lastName and login $this->username".PHP_EOL;
    }
    public function getUuid():UUID{
        return $this->uuid;
    }
    public function getName():Name{
        return $this->name;
    }
    public function getUserName():string{
        return $this->username;
    }
}