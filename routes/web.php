<?php
include_once 'config/static.php';
include_once 'controller/main.php';
include_once 'function/main.php';

# route untuk CRUD post
Router::url('dashboard', 'get', 'PostController::index');
Router::url('post/create', 'post', 'PostController::store');
Router::url('post/edit', 'get', 'PostController::edit');
Router::url('post/update', 'post', 'PostController::update');
Router::url('post/delete', 'get', 'PostController::destroy');

# route untuk login
Router::url('/', 'get', function () { return view('auth/login'); });
# route untuk registrasi
Router::url('register', 'post', 'RegisterController::register');
Router::url('user/register', 'get', function() {return view('auth/registrasi');});

new Router();