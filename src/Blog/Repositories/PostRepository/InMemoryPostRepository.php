<?php

namespace Tgu\Mityutyuk\Blog\Repositories\PostRepository;

use Tgu\Mityutyuk\Blog\Post;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\PostNotFoundException;

class InMemoryPostRepository implements PostsRepositoryInterface
{
    private array $posts = [];

    public function savePost(Post $post):void{
        $this->posts[] = $post;
    }

    public function getByUuidPost(UUID $uuidPost): Post
    {
        foreach ($this->posts as $post){
            if((string)$post->getUuid() === $uuidPost)
                return $post;
        }
        throw new PostNotFoundException("Posts not found $uuidPost");
    }
}