<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/table', function (){
    return view('tables');
});
Route::get('/', 'User@signin');
Route::post('user/login', 'User@login');
Route::get('user/logout', 'User@logout');
Route::group(['middleware' => 'auth'], function () {
    Route::get('user/create', 'User@create');


    Route::get('system/route', 'FinancialaidssystemController@index');



    Route::get('financial-aids-system/new-request', 'FinancialaidssystemController@create');
    Route::post('financial-aids-system/requesterpastrequest', 'FinancialaidssystemController@requesterpastrequest');
    Route::post('financial-aids-system/new-request/store', 'FinancialaidssystemController@store');
    Route::post('financial-aids-system/request/first-check', 'FinancialaidssystemController@firstcheck');
    Route::post('financial-aids-system/request/approved', 'FinancialaidssystemController@approved');
    Route::post('financial-aids-system/request/exchange', 'FinancialaidssystemController@exchange');
    Route::post('financial-aids-system/request/save', 'FinancialaidssystemController@saverequest');
    Route::post('financial-aids-system/request/unsave', 'FinancialaidssystemController@unsaverequest');
    Route::get('financial-aids-system/new-requests-list', 'FinancialaidssystemController@newRequestsList');
    Route::get('financial-aids-system/exchange-requests-list', 'FinancialaidssystemController@exchangeRequestsList');
    Route::get('financial-aids-system/approved-requests-list', 'FinancialaidssystemController@approvedRequestsList');
    Route::get('financial-aids-system/waiting-exchange-requests-list', 'FinancialaidssystemController@waitingexchangeRequestsList');
    Route::get('financial-aids-system/checked-requests-list', 'FinancialaidssystemController@checkedRequestsList');
    Route::get('financial-aids-system/saved-requests-list', 'FinancialaidssystemController@savedRequestsList');
    Route::get('financial-aids-system/requests-info/{id}', 'FinancialaidssystemController@show');
    Route::get('financial-aids-system/exchange-requestso/{id}', 'FinancialaidssystemController@exchangerequests');
    Route::get('financial-aids-system/user-requests-list/{civilid}', 'FinancialaidssystemController@userRequestsList');
    
    Route::get('system-control/requests', 'SystemControl@requests');
    Route::post('system-control/requests/addnew', 'SystemControl@requestsaddnew');
    Route::post('system-control/requests/update', 'SystemControl@requestsupdate');
    
    Route::get('system-control', 'SystemControl@index');
    Route::get('system-control/users', 'SystemControl@users');
    Route::get('system-control/budget', 'SystemControl@budget');
    Route::post('system-control/budget/store', 'SystemControl@storebudget');
    Route::post('system-control/system-pages/access-users', 'SystemControl@pagesaccessusers');
    Route::post('system-control/system-pages/store', 'SystemControl@storesystempage');
    Route::post('system-control/system-pages/update', 'SystemControl@updatesystempage');
    Route::post('system-control/system-pages/delete', 'SystemControl@deletesystempage');
    Route::get('system-control/system-pages', 'SystemControl@systempages');
    
    Route::post('system-control/search', 'SystemControl@search');
    Route::get('user/profile', 'User@profile');
    Route::get('system-control/user-info/{id}', 'User@show');
    Route::get('system-control/user-info/requests-list/{id}', 'User@userrequestslist');
    Route::get('user/profile/requests-list/{id}', 'User@userrequestslist');

    Route::post('user/store', 'User@store');
    Route::post('user/update', 'User@update');
    Route::post('user/updatepass', 'User@updatepass');
    Route::post('user/updateemail', 'User@updateemail');
    Route::post('user/updateuserpageacessuth', 'User@updateaccessauth');


        Route::get('financial-aids-system/statistics/{year?}', 'FinancialaidssystemController@index');

    Route::get('export/all/{flag}', 'ListExpostController@alllist');
});

