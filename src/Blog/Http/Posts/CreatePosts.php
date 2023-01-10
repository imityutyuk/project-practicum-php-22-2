<?php

namespace Tgu\Mityutyuk\Blog\Http\Actions\Posts;

use Tgu\Mityutyuk\Blog\Http\Actions\ActionInterface;
use Tgu\Mityutyuk\Blog\Http\ErrorResponse;
use Tgu\Mityutyuk\Blog\Http\Request;
use Tgu\Mityutyuk\Blog\Http\Response;
use Tgu\Mityutyuk\Blog\Http\SuccessResponse;
use Tgu\Mityutyuk\Blog\Repositories\PostRepository\PostsRepositoryInterface;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\HttpException;
use Tgu\Mityutyuk\Exceptions\PostNotFoundException;

class CreatePosts implements ActionInterface
{
    public function __construct(
        private PostsRepositoryInterface $postsRepository
    )
    {
    }

    public function handle(Request $request): Response
    {
        try {
            $uuid = UUID::random();
            $id = $request->query('uuid_post');
            $post = $this->postsRepository->getByUuidPost($uuid);
        }
        catch (HttpException | PostNotFoundException $exception ){
            return new ErrorResponse($exception->getMessage());
        }
        $this->postsRepository->savePost($post);
        return new SuccessResponse(['uuid_post'=>$id, 'uuid_author'=>$post->getUuidUser(), 'title'=>$post->getTitle(), 'text'=>$post->getTextPost()]);
    }
}