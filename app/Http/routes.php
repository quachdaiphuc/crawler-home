<?php

    # Static Pages. Redirecting admin so admin cannot access these pages.
    Route::group(['middleware' => ['redirectAdmin']], function()
    {
        Route::get('/', ['as' => 'home', 'uses' => 'PagesController@getHome']);
        Route::get('/product/{id}/{slug}', ['as' => 'product.detail', 'uses' => 'PagesController@getDetailProduct']);
        Route::get('/filter/{listID}', ['as' => 'filter.ajax', 'uses' => 'PagesController@getProductListFilterAjax']);
        Route::get('/category/{id}/{slug}', ['as' => 'category.detail', 'uses' => 'PagesController@getDetailCategory']);
        Route::get('/search', ['as' => 'search', 'uses' => 'PagesController@getResultSearch']);
    });

    # Registration
    Route::group(['middleware' => 'guest'], function()
    {
        Route::get('register', 'RegistrationController@create');
        Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);
    });

    # Authentication
    Route::get('login', ['as' => 'login', 'middleware' => 'guest', 'uses' => 'SessionsController@create']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
    Route::resource('sessions', 'SessionsController' , ['only' => ['create','store','destroy']]);

    # Forgotten Passwordjhh
    Route::group(['middleware' => 'guest'], function()
    {
        Route::get('forgot_password', 'Auth\PasswordController@getEmail');
        Route::post('forgot_password','Auth\PasswordController@postEmail');
        Route::get('reset_password/{token}', 'Auth\PasswordController@getReset');
        Route::post('reset_password/{token}', 'Auth\PasswordController@postReset');
    });

    # Standard User Routes
    Route::group(['middleware' => ['auth','standardUser']], function()
    {
        Route::get('userProtected', 'StandardUser\StandardUserController@getUserProtected');
        Route::resource('profiles', 'StandardUser\UsersController', ['only' => ['show', 'edit', 'update']]);
    });

    # Admin Routes
    Route::group(['middleware' => ['auth', 'admin']], function()
    {
        Route::group(['prefix' => 'admin'], function() {
            Route::get('/', ['as' => 'admin_dashboard', 'uses' => 'Admin\AdminController@getHome']);
//            Route::resource('member', 'Admin\AdminMembersController');
//            #category Manage
//            Route::resource('category', 'Admin\CategoryController');
//            Route::post('category/destroy', ['as' => 'category/destroy', 'uses' => 'Admin\CategoryController@destroy']);
//
//            #product Manage
//            Route::resource('product', 'Admin\ProductController');
//            Route::post('product/destroy', ['as' => 'product/destroy', 'uses' => 'Admin\ProductController@destroy']);

            #news Manage
            Route::resource('news', 'Admin\NewsController');
            Route::post('news/destroy', ['as' => 'news/destroy', 'uses' => 'Admin\NewsController@destroy']);

            #crawl tool
            Route::get('/tool', 'Admin\CrawlToolController@index');
            Route::post('/add-form-setting', ['as' => 'add-form-setting', 'uses' => 'Admin\CrawlToolController@addFormSetting']);
            Route::post('/get-table-field', ['as' => 'get-table-field', 'uses' => 'Admin\CrawlToolController@getTableField']);
            Route::post('/tool', ['as' => 'admin.tool.store', 'uses' => 'Admin\CrawlToolController@store']);
            Route::post('/save-data', ['as' => 'admin.tool.save', 'uses' => 'Admin\CrawlToolController@saveData']);

            Route::post('/save-setting', ['as' => 'save-setting', 'uses' => 'Admin\CrawlToolController@saveSetting']);
            Route::post('/load-setting', ['as' => 'load-setting', 'uses' => 'Admin\CrawlToolController@loadSetting']);
            Route::post('/load-setting-item', ['as' => 'load-setting-item', 'uses' => 'Admin\CrawlToolController@loadSettingItem']);
            Route::post('/check-name', ['as' => 'check-name', 'uses' => 'Admin\CrawlToolController@checkName']);

            //delete data
            Route::get('/delete-data', ['as' => 'admin.tool.delete', 'uses' => 'Admin\CrawlToolController@deleteAll']);
        });
    });
