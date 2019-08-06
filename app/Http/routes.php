<?php
Route::pattern('id', '[0-9]+');
Route::pattern('id1', '[0-9]+');
Route::pattern('id2', '[0-9]+');
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

//Route::get('/', function () {
//    return view('welcome');
//});

    Route::get('/',                     ['as' =>'user.home',                        'uses' =>'User\HomeController@index']);
    Route::get('login',                 ['as' =>'user.login',                       'uses' =>'User\HomeController@login']);
    Route::get('register',              ['as' =>'user.register',                    'uses' =>'User\HomeController@register']);
    Route::post('store',                ['as' =>'user.store',                       'uses' =>'User\HomeController@store']);
    Route::post('doLogin',              ['as' =>'user.doLogin',                     'uses' =>'User\HomeController@doLogin']);
    Route::get('doLogout',              ['as' =>'user.doLogout',                    'uses' =>'User\HomeController@doLogout']);
    Route::get('dashboard',             ['as' =>'user.dashboard',                   'uses' =>'User\DashboardController@index']);
    Route::get('new-contact',           ['as' =>'user.newContact',                  'uses' =>'User\ContactController@index']);
    Route::post('addTag',               ['as' =>'user.contact.addTag',              'uses' =>'User\ContactController@addTag']);
    Route::post('addCategory',          ['as' =>'user.contact.addCategory',         'uses' =>'User\ContactController@addCategory']);
    Route::post('addIndustry',          ['as' =>'user.contact.addIndustry',         'uses' =>'User\ContactController@addIndustry']);
    Route::post('addType',              ['as' =>'user.contact.addType',             'uses' =>'User\ContactController@addType']);
    Route::post('addPeople',            ['as' =>'user.contact.addPeople',           'uses' =>'User\ContactController@addPeople']);
    Route::get('address/{id}',          ['as' =>'user.contact.address',             'uses' =>'User\ContactController@address']);
    Route::post('addAddress',           ['as' =>'user.contact.addAddress',          'uses' =>'User\ContactController@addAddress']);
    Route::post('getAddress',           ['as' =>'user.contact.getAddress',          'uses' =>'User\ContactController@getAddress']);
    Route::get('main/{id}',             ['as' =>'user.contact.main',                'uses' =>'User\ContactController@main']);
    Route::post('addNote',              ['as' =>'user.contact.addNote',             'uses' =>'User\ContactController@addNote']);
    Route::post('getNote',              ['as' =>'user.contact.getNote',             'uses' =>'User\ContactController@getNote']);
    Route::post('searchMainNote',       ['as' =>'user.contact.searchMainNote',      'uses' =>'User\ContactController@searchMainNote']);
    Route::get('search-contact',        ['as' =>'user.contact.searchContact',      'uses' =>'User\ContactController@searchContact']);
    Route::post('getContact',           ['as' =>'user.contact.getContact',          'uses' =>'User\ContactController@getContact']);
    Route::get('search-note',           ['as' =>'user.contact.noteContact',         'uses' =>'User\ContactController@noteContact']);
    Route::post('getNoteContact',       ['as' =>'user.contact.getNoteContact',      'uses' =>'User\ContactController@getNoteContact']);
    Route::post('searchNoteContent',    ['as' =>'user.contact.searchNoteContent',   'uses' =>'User\ContactController@searchNoteContent']);
    Route::get('project/{id}/{id1}',    ['as' =>'user.project',                     'uses' =>'User\ProjectController@project']);
    Route::get('add-project/{id}',      ['as' =>'user.project.add',                 'uses' =>'User\ProjectController@add']);
    Route::post('addProject',           ['as' =>'user.project.addProject',          'uses' =>'User\ProjectController@addProject']);
    Route::post('editProjectSection',   ['as' =>'user.project.editProjectSection',  'uses' =>'User\ProjectController@editProjectSection']);
    Route::post('addZones',             ['as' =>'user.project.addZones',            'uses' =>'User\ProjectController@addZones']);
    Route::post('editZones',            ['as' =>'user.project.editZones',            'uses' =>'User\ProjectController@editZones']);
    Route::post('editZonesStore',       ['as' =>'user.project.editZonesStore',       'uses' =>'User\ProjectController@editZonesStore']);
    Route::get('add-quote/{id}/{id1}',  ['as' =>'user.project.addQuote',             'uses' =>'User\ProjectController@addQuote']);
    Route::get('quote/{id}/{id1}/{id2}',['as' =>'user.project.quote',                'uses' =>'User\ProjectController@quote']);
    Route::post('storeQuote',           ['as' =>'user.project.storeQuote',           'uses' =>'User\ProjectController@storeQuote']);
    Route::any('deleteZone/{id}',       ['as' =>'user.project.deleteZone',           'uses' =>'User\ProjectController@deleteZone']);
