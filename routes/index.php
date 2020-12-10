<?php

Route::get("/" , "postController::index");
Route::get("post" , "postController::index");
Route::get("post/:d" , "postController::show");
Route::get("page/:d/:w" , "postController::showDetail");

Route::get("api" , "postController::api");
Route::post("api" , "postController::api");