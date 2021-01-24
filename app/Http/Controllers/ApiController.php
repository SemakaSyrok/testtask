<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleResourceCollection;
use App\Models\Comment;
use App\Models\Post;
use App\Service\PostService;

class ApiController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }
    
    public function articles()
    {
        return ArticleResourceCollection::make(Post::orderBy('id', 'DESC')->paginate(6));
    }

    public function main()
    {
        return ArticleResourceCollection::make(Post::orderBy('id', 'DESC')->limit(6)->get());
    }

    public function article(Post $post)
    {
        return new ArticleResource($post);
    }

    public function like(Post $post)
    {
        return $this->postService->like($post);
    }

    public function view(Post $post)
    {
        return $this->postService->view($post);
    }

    public function comment(CommentRequest $request)
    {
        sleep(2);
        return Comment::create($request->toArray())->toArray();
    }
}
