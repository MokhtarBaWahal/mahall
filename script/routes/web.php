<?php

use Illuminate\Support\Facades\Route;

Route::get('/',function(){
	return redirect('/install');
});

// Temporary: clear all caches (remove after use)
Route::get('/clear-cache-mahal', function() {
	\Artisan::call('view:clear');
	\Artisan::call('cache:clear');
	\Artisan::call('config:clear');
	\Artisan::call('route:clear');
	return 'All caches cleared! You can remove this route now.';
});

