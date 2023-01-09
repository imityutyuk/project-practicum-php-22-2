<?php

require_once __DIR__ . '/vendor/autoload.php';

use Tgu\Mityutyuk\Blog\Post;
use Tgu\Mityutyuk\Person\Name;
use Tgu\Mityutyuk\Person\Person;
use Tgu\Mityutyuk\Blog\Comment;

spl_autoload_register(function ($class){
    $file = str_replace("/",DIRECTORY_SEPARATOR, $class). '.php';
    $file[strrpos($file, '_')] = '\\';
    echo $file;
    if (file_exists($file)){
        require $file;
    }
});

$post = new Post(
    new Person(
        new Name(1, 'Иван', 'Иванов'),

    ),
    'Привет!', 2, 1, ''
);

$comment = new Comment(
    1, 1, 2, ''
);

print $post;