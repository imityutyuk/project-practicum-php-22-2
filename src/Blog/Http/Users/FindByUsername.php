<?php

namespace Tgu\Mityutyuk\Blog\Http\Actions\Users;

use Tgu\Mityutyuk\Blog\Http\Actions\ActionInterface;
use Tgu\Mityutyuk\Blog\Http\ErrorResponse;
use Tgu\Mityutyuk\Blog\Http\Request;
use Tgu\Mityutyuk\Blog\Http\Response;
use Tgu\Mityutyuk\Blog\Http\SuccessResponse;
use Tgu\Mityutyuk\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Mityutyuk\Exceptions\HttpException;
use Tgu\Mityutyuk\Exceptions\UserNotFoundException;

class FindByUsername implements ActionInterface
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $username = $request->query('username');
            $user =$this->usersRepository->getByUsername($username);
        }
        catch (HttpException | UserNotFoundException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        return new SuccessResponse(['username'=>$user->getUserName(),'name'=>$user->getName()->getFirstName().' '.$user->getName()->getLastName()]);
    }
}