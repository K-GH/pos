<?php 

Route::prefix('dashboard')->name('dashboard.')->group(function(){

   /* Route::get('/check', function () {
        //return 'this is dashboard';
        return view('dashboard.index');
    });*/

    Route::get('index', 'DashboardController@index')->name('dashboard.index');

});