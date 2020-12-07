<?php

Route::add("/" , "postController::index");
Route::add("post" , "postController::index");
Route::add("post/:d" , "postController::show");
Route::add("page/:d/:w" , "postController::showDetail");