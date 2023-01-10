<?php

namespace Tgu\Mityutyuk\Blog\Repositories\UserRepository;

use Tgu\Mityutyuk\Blog\User;
use Tgu\Mityutyuk\Blog\UUID;

interface UsersRepositoryInterface
{
    public function save(User $user):void;
    public function getByUsername(string $username):User;
    public function getByUuid(UUID $uuid): User;
}