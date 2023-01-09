<?php

namespace Tgu\Mityutyuk\Blog;

class Comment
{
    private $idComm;
    private $idUser;
    private $idPost;
    private $text;

    public function __construct(
        int $idComm,
        Name $idUser,
        Post $idPost,
        string $text
)
{
    $this->text = $text;
    $this->idPost = $idPost;
    $this->idUser = $idUser;
    $this->idComm = $idComm;

}
    public function __toString(): string
    {
        return $this->idComm . ' ' .$this->idUser . ' ' .$this->idPost . ' ' . $this->text;
    }
}
