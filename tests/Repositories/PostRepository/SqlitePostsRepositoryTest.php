<?php

namespace Tgu\Mityutyuk\PhpUnit\Repositories\PostRepository;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Mityutyuk\Blog\Post;
use Tgu\Mityutyuk\Blog\Repositories\PostRepository\SqlitePostsRepository;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\PostNotFoundException;

class SqlitePostsRepositoryTest extends TestCase
{
    public function testItTrowsAnExceptionWhenPostNotFound():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionStub);

        $this->expectException(PostNotFoundException::class);
        $this->expectExceptionMessage('Cannot get post: Hdsadas');

        $repository->getTextPost('Hdsadas');
    }

    public function testItSavePostToDB():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createMock(PDOStatement::class);

        $statementStub
            ->expects($this->once())
            ->method('execute')
            ->with([
                ':uuid_post' =>'5b78178a-eda3-4e85-9a62-90f5a0320c4e',
                ':uuid_author'=>'f76cfc25-f8b2-4d15-9775-944db6648a82',
                ':title'=>'Title1',
                ':text'=>'Hdsadas']);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionStub);

        $repository->savePost(new Post(
            new UUID('5b78178a-eda3-4e85-9a62-90f5a0320c4e'), 'f76cfc25-f8b2-4d15-9775-944db6648a82','Title1','Hdsadas'
        ));
    }

    public function testItUUidPosts():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqlitePostsRepository($connectionStub);

        $this->expectException(PostNotFoundException::class);


        $repository->getByUuidPost('edb10650-3b52-4a8e-b05c-c5a1f167bed0');
    }
}