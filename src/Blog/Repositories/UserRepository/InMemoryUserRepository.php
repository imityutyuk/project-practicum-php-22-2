<?php

namespace Tgu\Mityutyuk\Blog\Repositories\UserRepository;

use Tgu\Mityutyuk\Blog\User;
use Tgu\Mityutyuk\Exceptions\UserNotFoundException;

class InMemoryUserRepository
{
    private array $users=[];
    public function save (User $user):void
    {
        $this->users[] =$user;
    }
    public function get(int $id):User
    {
        foreach ($this->users as $user){
            if ($user->getId()=== $id){
                return $user;
            }

        }
        throw new UserNotFoundException("User not found: $id");
    }
}
