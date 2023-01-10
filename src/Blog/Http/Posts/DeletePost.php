<?php

namespace Tgu\Mityutyuk\Blog\Http\Actions\Posts;

use Tgu\Mityutyuk\Blog\Http\Actions\ActionInterface;
use Tgu\Mityutyuk\Blog\Http\ErrorResponse;
use Tgu\Mityutyuk\Blog\Http\Request;
use Tgu\Mityutyuk\Blog\Http\Response;
use Tgu\Mityutyuk\Blog\Http\SuccessResponse;
use Tgu\Mityutyuk\Blog\Repositories\PostRepository\PostsRepositoryInterface;
use Tgu\Mityutyuk\Exceptions\HttpException;
use Tgu\Mityutyuk\Exceptions\PostNotFoundException;

class DeletePost implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    )
    {
    }
    public function handle(Request $request): Response
    {
        try {
            $uuid = $request->query('uuid_post');
        }
        catch (HttpException | PostNotFoundException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->postsRepository->getByUuidPost($uuid);
        return new SuccessResponse(['uuid_post'=>$uuid]);
    }
}