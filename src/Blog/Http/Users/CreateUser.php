<?php

namespace Tgu\Mityutyuk\Blog\Http\Actions\Users;

use Tgu\Mityutyuk\Blog\Http\Actions\ActionInterface;
use Tgu\Mityutyuk\Blog\Http\ErrorResponse;
use Tgu\Mityutyuk\Blog\Http\Request;
use Tgu\Mityutyuk\Blog\Http\Response;
use Tgu\Mityutyuk\Blog\Http\SuccessResponse;
use Tgu\Mityutyuk\Blog\Repositories\UserRepository\UsersRepositoryInterface;
use Tgu\Mityutyuk\Blog\User;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\HttpException;

class CreateUser implements ActionInterface
{
    public function __construct(
        private UsersRepositoryInterface $usersRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $newUserUuid = UUID::random();
            $user = new User($newUserUuid,new Name($request->jsonBodyFind('first_name'), $request->jsonBodyFind('last_name')), $request->jsonBodyFind('username'));
        }
        catch (HttpException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->usersRepository->save($user);
        return new SuccessResponse(['uuid'=>(string)$newUserUuid]);
    }

}