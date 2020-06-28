<?php 

/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    
        //ana hena mest5dm name m3a algroup 3lshan aw7d kol ely haygy b3dhom be start mo3ena
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

            /* Route::get('/check', function () {
                //return 'this is dashboard';
                return view('dashboard.index');
            });*/
        
        
            //ana bast5dm al name 3lshan lma agy acall route de fe href fil view masln 
            Route::get('index', 'DashboardController@index')->name('index');

            //user route
            Route::resource('users', 'UserController')->except('show');
        
        });

});
