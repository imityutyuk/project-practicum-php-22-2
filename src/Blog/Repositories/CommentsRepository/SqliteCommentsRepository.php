<?php

namespace Tgu\Mityutyuk\Blog\Repositories\CommentsRepository;

use PDO;
use PDOStatement;
use Tgu\Mityutyuk\Blog\Comments;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\CommentNotFoundException;

class SqliteCommentsRepository implements CommentsRepositoryInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;

    }

    public function saveComment(Comments $comment):void{
        $statement = $this->connection->prepare(
            "INSERT INTO comments (uuid_comment, uuid_post, uuid_author, textCom) VALUES (:uuid_comment,:uuid_post,:uuid_author, :textCom)");
        $statement->execute([
            ':uuid_comment'=>(string)$comment->getUuidComment(),
            ':uuid_post'=>$comment->getUuidPost(),
            ':uuid_author'=>$comment->getUuidUser(),
            ':textCom'=>$comment->getTextComment()]);
    }

    private function getComment(PDOStatement $statement, string $value):Comments{
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result===false){
            throw new CommentNotFoundException("Cannot get comment: $value");
        }
        return new Comments(new UUID($result['uuid_comment']), $result['uuid_post'], $result['uuid_author'], $result['textCom']);
    }

    public function getByUuidComment(UUID $uuid_comment): Comments
    {
        $statement = $this->connection->prepare(
            "SELECT * FROM comments WHERE uuid_comment = :uuid_comment"
        );
        $statement->execute([':uuid_comment'=>(string)$uuid_comment]);
        return $this->getComment($statement, (string)$uuid_comment);
    }
}