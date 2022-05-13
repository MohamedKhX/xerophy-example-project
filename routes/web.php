<?php

use App\Controllers\PostsController;
use Xerophy\Framework\Application\Application;
use Xerophy\Framework\Routing\Router;


/**.
 *
 * -------- Get the router from the application --------
 *
 * @var $router Router
 * @var $app Application
 * */
$router = $app->getRouter();

/**
 * -------- Start register your routes here (: --------
 */

$router->view('/', 'index.html.twig');


$router->get   ('/posts',             [PostsController::class, 'index' ])->name('posts-index');
$router->get   ('/post/create',       [PostsController::class, 'create'])->name('posts-create');
$router->post  ('/post/create',       [PostsController::class, 'store' ]);
$router->get   ('/post/:id',          [PostsController::class, 'show'  ])->name('posts-show');
$router->get   ('/post/:id/edit',     [PostsController::class, 'edit'  ])->name('posts-edit');
$router->put   ('/post/:id/edit',     [PostsController::class, 'update']);
$router->delete('/post/:id/delete',   [PostsController::class, 'delete'])->name('posts-delete');