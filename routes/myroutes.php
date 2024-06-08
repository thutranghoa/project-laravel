<?php

Route :: middleware ('auth') -> get ('/myroute', function () {
    return view ('welcome');
});

Route :: middleware ('auth') -> group (function () {
    Route :: get ('view', 'App\Http\Controllers\NewsController@view');

    Route :: get ('update/{id}', 'App\Http\Controllers\NewsController@update');

    Route :: get ('delete/{id}', 'App\Http\Controllers\NewsController@delete');

    Route :: get ('addnew', 'App\Http\Controllers\NewsController@add') -> name ('news.addnew');
    Route :: post ('addnew', 'App\Http\Controllers\NewsController@insert') -> name ('news.insert');

    Route :: get ('edit/{id}', 'App\Http\Controllers\NewsController@edit') -> name ('news.edit');
    Route :: post ('edit/{id}', 'App\Http\Controllers\NewsController@update') -> name ('news.update');

    Route :: get ('list', 'App\Http\Controllers\NewsController@list') -> name ('news.list');
});


Route::get('test',  'App\Http\Controllers\NewsController@test');

Route :: get ('/user/{id}', function(string $id){
    return 'User '.$id;
});

Route :: get ('/posts/{post}/comments/{comment}', function(string $postId, string $commentId){
});


