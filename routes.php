<?php
require_once("Router/Route.php");
use Router\Route;

Route::get("/user","Controllers\UserController@index");
Route::get("/showuser","Controllers\UserController@show");
Route::post("/upuser","Controllers\UserController@update");
Route::post("/cuser","Controllers\UserController@create");
Route::post("/duser","Controllers\UserController@delete");

Route::post("/createauthor","Controllers\AuthorController@createAuthor");
Route::get("/listauthors","Controllers\AuthorController@listAuthors");
Route::get("/showauthor","Controllers\AuthorController@showAuthor");
Route::post("/updateauthor","Controllers\AuthorController@updateAuthor");
Route::post("/deleteauthor","Controllers\AuthorController@deleteAuthor");

Route::post("/createbook","Controllers\BookController@createBook");
Route::get("/listbooks","Controllers\BookController@listBooks");
Route::get("/showbook","Controllers\BookController@showBook");
Route::post("/updatebook","Controllers\BookController@updateBook");
Route::post("/deletebook","Controllers\BookController@deleteBook");