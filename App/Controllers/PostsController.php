<?php

namespace App\Controllers;

use App\Models\Post;
use Cassandra\Date;
use Symfony\Component\VarDumper\Cloner\Data;
use Xerophy\Framework\Http\Request;

class PostsController extends Controller
{
    /**
     * Show all posts
     *
     * @return void
     * */
    public function index(): void
    {
        $posts = Post::all();
        $this->render('posts/index.html.twig', ['posts' => $posts]);
    }

    /**
     * Show a single post
     *
     * @param $id
     * @return void
     * */
    public function show($id): void
    {
        $post = Post::getById($id);
        $this->render('posts/show.html.twig', ['post' => $post]);
    }

    /**
     * Render the create page
     * */
    public function create(): void
    {
        $this->render('posts/create.html.twig');
    }

    /**
     * Store the data to database
     *
     * @param Request $request
     * @return void
     * */
    public function store(Request $request): void
    {
        $request->validate([
            'title'       => 'required|between:6:32',
            'description' => 'required|min:16'
        ]);

        $post = new Post();
        $post->title       = $request->title;
        $post->description = $request->description;

        $post->save();

        redirect(route('posts-index'));
    }

    /**
     * Render the edit page
     *
     * @param $id
     * @return void
     * */
    public function edit($id): void
    {
        $post = Post::getById($id);
        $this->render('posts/edit.html.twig', ['post' => $post]);
    }

    /**
     * Update the data
     *
     * @param Request $request
     * @param $id
     *
     * @return void
     * */
    public function update(Request $request, $id): void
    {
        $request->validate([
            'title'       => 'required|between:6:32',
            'description' => 'required|min:16'
        ]);

        $post              = Post::getById($id);
        $post->title       = $request->title;
        $post->description = $request->description;

        $post->save();

        redirect(route('posts-index'));
    }

    /**
     * Delete a post by id
     *
     * @param $id
     * @return void
     * */
    public function delete($id): void
    {
        Post::delete($id);
        redirect(route('posts-index'));
    }
}