<?php
session_start();

require_once 'Core/Router.php';

Router::get('/', 'Home', 'index');

Router::get('/login', 'Auth', 'loginForm');
Router::post('/login', 'Auth', 'login');

Router::post('/logout', 'Auth', 'logout');

Router::get('/register', 'Auth', 'registerForm');
Router::post('/register', 'Auth', 'register');


new Router;
