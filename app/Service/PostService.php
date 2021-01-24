<?php

namespace App\Service;

use App\Lib\RedisLib;
use App\Models\Post;

class PostService
{
    public function like(Post $post)
    {
        $increments = RedisLib::getConnectionById($post->id)
            ->zincrby('likes', 1, $post->id);

        return $increments + $post->likes;
    }

    public function view(Post $post)
    {
        $increments = RedisLib::getConnectionById($post->id)
            ->zincrby('views', 1, $post->id);

        return $increments + $post->views;
    }
}