<?php

namespace Tgu\Mityutyuk\Blog\Repositories\CommentsRepository;


use Tgu\Mityutyuk\Blog\Comments;
use Tgu\Mityutyuk\Blog\UUID;

interface CommentsRepositoryInterface
{
    public function saveComment(Comments $comment):void;
    public function getByUuidComment(UUID $uuid_comment): Comments;
}
