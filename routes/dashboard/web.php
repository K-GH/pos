<?php 

/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    
        //ana hena mest5dm name m3a algroup 3lshan aw7d kol ely haygy b3dhom be start mo3ena
        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function(){

            /* Route::get('/check', function () {
                //return 'this is dashboard';
                return view('dashboard.welcome');
            });*/
        
        
            //ana bast5dm al name 3lshan lma agy acall route de fe href fil view masln 
            Route::get('/', 'WelcomeController@index')->name('welcome');

            //user route
            Route::resource('users', 'UserController')->except('show');

            //categories route
            Route::resource('categories', 'CategoryController')->except('show');

            //products route
            Route::resource('products', 'ProductController')->except('show');

             //Clients route
             Route::resource('clients', 'ClientController')->except('show');

            //Clients order route
            Route::resource('clients.orders', 'Client\OrderController')->except('show');
            
            //general order route
            Route::resource('orders', 'OrderController')->except('show');


        
        });

});
