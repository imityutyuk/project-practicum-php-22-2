<?php

namespace Tgu\Mityutyuk\Blog\Repositories\UserRepository;

use Tgu\Mityutyuk\Blog\User;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\UserNotFoundException;

class InMemoryUserRepository implements UsersRepositoryInterface
{
    private array $users = [];

    public function save(User $user): void
    {
        $this->users[] = $user;
    }

    public function getByUsername(string $username): User
    {
        foreach ($this->users as $user) {
            if ((string)$user->getUsername() === $username)
                return $user;
        }
        throw new UserNotFoundException("Users not found $username");
    }

    public function getByUuid(UUID $uuid): User
    {
        foreach ($this->users as $user) {
            if ((string)$user->getUuid() === $uuid)
                return $user;
        }
        throw new UserNotFoundException("Users not found $uuid");
    }
}
