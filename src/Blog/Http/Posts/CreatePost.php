<?php

namespace Tgu\Mityutyuk\Blog\Http\Actions\Posts;

use Tgu\Mityutyuk\Blog\Http\Actions\ActionInterface;
use Tgu\Mityutyuk\Blog\Http\ErrorResponse;
use Tgu\Mityutyuk\Blog\Http\Request;
use Tgu\Mityutyuk\Blog\Http\Response;
use Tgu\Mityutyuk\Blog\Http\SuccessResponse;
use Tgu\Mityutyuk\Blog\Post;
use Tgu\Mityutyuk\Blog\Repositories\PostRepository\PostsRepositoryInterface;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\HttpException;

class CreatePost implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    )
    {

    }

    public function handle(Request $request): Response
    {
        try {
            $newPostUuid = UUID::random();
            $post = new Post($newPostUuid, $request->jsonBodyFind('uuid_author'), $request->jsonBodyFind('title'), $request->jsonBodyFind('text'));
        }
        catch (HttpException $exception){
            return new ErrorResponse($exception->getMessage());
        }
        $this->postsRepository->savePost($post);
        return new SuccessResponse(['uuid_post'=>$newPostUuid]);
    }
}