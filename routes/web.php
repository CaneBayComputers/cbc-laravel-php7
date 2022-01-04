<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{slug}', function ($template) {

    if( $template == '/' ) $template = 'index';

    $view = 'content.' . str_replace('/', '.', $template);

    if( ! View::exists($view) ) abort(404);

    return view($view);

})->where('slug', '^[A-Za-z0-9_\/\-]+$');
