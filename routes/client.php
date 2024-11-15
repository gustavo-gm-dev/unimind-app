<?php

Route::get('/register-client', function () {
    return view('client.register');
})->middleware(['auth', 'verified'])->name('register-client');
