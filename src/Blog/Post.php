<?php
namespace Tgu\Mityutyuk\Blog;

use Tgu\Mityutyuk\Person\Person;

class Post
{
    private $person;
    private $text;
    private $idPost;
    private $idUser;
    private $title;

    public function __construct(
        Person $person,
        string $text,
        int $idPost,
        Name $idUser,
        string $title
)
{
    $this->title = $title;
    $this->idUser = $idUser;
    $this->idPost = $idPost;
    $this->text = $text;
    $this->person = $person;
}
    public function __toString(): string
    {
        return $this->id . ' ' .$this->idAuth . ' ' .$this->title . ' ' . $this->text;
    }
}
