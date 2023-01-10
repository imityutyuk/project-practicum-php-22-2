<?php

namespace Tgu\Mityutyuk\Blog\Commands;

use Tgu\Mityutyuk\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Mityutyuk\Blog\User;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\CommandException;
use Tgu\Mityutyuk\Exceptions\UserNotFoundException;
use Tgu\Mityutyuk\Person\Name;

class CreateUserCommand
{
    public function __construct(private UsersRepositoryInterface $usersRepository)
    {
    }

    public function handle(Arguments $arguments):void{
        $username = $arguments->get('username');
        if($this->userExist($username)){
            throw new CommandException("User already exists: $username");
        }
        $this->usersRepository->save(new User(UUID::random(), new Name($arguments->get('first_name'), $arguments->get('last_name')),$username));
    }
    public function userExist(string $username):bool{
        try{
            $this->usersRepository->getByUsername($username);
        }
        catch (UserNotFoundException $exception){
            return false;
        }
        return true;
    }
}