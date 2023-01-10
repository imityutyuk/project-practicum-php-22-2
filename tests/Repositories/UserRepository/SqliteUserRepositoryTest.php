<?php

namespace Tgu\Mityutyuk\PhpUnit\Repositories\UserRepository;

use PDO;
use PDOStatement;
use PHPUnit\Framework\TestCase;
use Tgu\Mityutyuk\Blog\Repositories\UserRepository\SqliteUsersRepository;
use Tgu\Mityutyuk\Blog\User;
use Tgu\Mityutyuk\Blog\UUID;
use Tgu\Mityutyuk\Exceptions\InvalidArgumentExceptions;
use Tgu\Mityutyuk\Exceptions\UserNotFoundException;
use Tgu\Mityutyuk\Person\Name;

class SqliteUsersRepositoryTest extends TestCase
{
    public function testItTrowsAnExceptionWhenUserNotFound():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUsersRepository($connectionStub);

        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage('Cannot get user: admin');

        $repository->getByUsername('admin');
    }

    public function testItSaveUserToDB():void
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createMock(PDOStatement::class);

        $statementStub
            ->expects($this->once())
            ->method('execute')
            ->with([
                ':first_name'=>'Ivan',
                ':last_name'=>'Ivanov',
                ':uuid' =>'cd6a4d34-3d65-44a5-bb52-90a0ce3efcb3',
                ':username'=>'admin'
            ]);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUsersRepository($connectionStub);

        $repository->save(new User(
            new UUID('cd6a4d34-3d65-44a5-bb52-90a0ce3efcb3'),
            new Name('Ivan', 'Ivanov'), 'admin'
        ));
    }

    /**
     * @throws UserNotFoundException
     */
    public function testItUUidUser ():User
    {
        $connectionStub = $this->createStub(PDO::class);
        $statementStub =  $this->createStub(PDOStatement::class);

        $statementStub->method('fetch')->willReturn(false);
        $connectionStub->method('prepare')->willReturn($statementStub);

        $repository = new SqliteUsersRepository($connectionStub);
        $this->expectException(UserNotFoundException::class);
        $this->expectExceptionMessage(' UUID: cd6a4d34-3d65-44a5-bb52-90a0ce3efcb3');

        $repository->getByUuid('cd6a4d34-3d65-44a5-bb52-90a0ce3efcb3');
    }

}