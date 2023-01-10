<?php

namespace Tgu\Mityutyuk\Blog\Repositories\PostRepositories;

use Tgu\Mityutyuk\Blog\Post;
use Tgu\Mityutyuk\Blog\UUID;

interface PostsRepositoryInterface
{
    public function savePost(Post $post):void;
    public function getByUuidPost(UUID $uuidPost): Post;
}