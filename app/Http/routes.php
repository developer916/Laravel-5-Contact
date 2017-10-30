<?php
Route::pattern('id', '[0-9]+');
Route::pattern('id1', '[0-9]+');
Route::pattern('id2', '[0-9]+');
Route::pattern('slug', '[a-zA-Z0-9-]+');
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

    Route::get('/',                             ['as' =>'user.home',                        'uses' =>'User\HomeController@index']);
    Route::get('login',                         ['as' =>'user.login',                       'uses' =>'User\HomeController@login']);
    Route::get('register',                      ['as' =>'user.register',                    'uses' =>'User\HomeController@register']);
    Route::post('store',                        ['as' =>'user.store',                       'uses' =>'User\HomeController@store']);
    Route::post('doLogin',                      ['as' =>'user.doLogin',                     'uses' =>'User\HomeController@doLogin']);
    Route::get('doLogout',                      ['as' =>'user.doLogout',                    'uses' =>'User\HomeController@doLogout']);
    Route::get('dashboard',                     ['as' =>'user.dashboard',                   'uses' =>'User\DashboardController@index']);
    Route::get('new-contact',                   ['as' =>'user.newContact',                  'uses' =>'User\ContactController@index']);
    Route::post('addTag',                       ['as' =>'user.contact.addTag',              'uses' =>'User\ContactController@addTag']);
    Route::post('addCategory',                  ['as' =>'user.contact.addCategory',         'uses' =>'User\ContactController@addCategory']);
    Route::post('addIndustry',                  ['as' =>'user.contact.addIndustry',         'uses' =>'User\ContactController@addIndustry']);
    Route::post('addType',                      ['as' =>'user.contact.addType',             'uses' =>'User\ContactController@addType']);
    Route::post('addPeople',                    ['as' =>'user.contact.addPeople',           'uses' =>'User\ContactController@addPeople']);
    Route::get('address/{id}',                  ['as' =>'user.contact.address',             'uses' =>'User\ContactController@address']);
    Route::post('addAddress',                   ['as' =>'user.contact.addAddress',          'uses' =>'User\ContactController@addAddress']);
    Route::post('getAddress',                   ['as' =>'user.contact.getAddress',          'uses' =>'User\ContactController@getAddress']);
    Route::get('main/{id}',                     ['as' =>'user.contact.main',                'uses' =>'User\ContactController@main']);
    Route::post('addNote',                      ['as' =>'user.contact.addNote',             'uses' =>'User\ContactController@addNote']);
    Route::post('getNote',                      ['as' =>'user.contact.getNote',             'uses' =>'User\ContactController@getNote']);
    Route::post('searchMainNote',               ['as' =>'user.contact.searchMainNote',      'uses' =>'User\ContactController@searchMainNote']);
    Route::get('search-contact',                ['as' =>'user.contact.searchContact',      'uses' =>'User\ContactController@searchContact']);
    Route::post('getContact',                   ['as' =>'user.contact.getContact',          'uses' =>'User\ContactController@getContact']);
    Route::get('search-note',                   ['as' =>'user.contact.noteContact',         'uses' =>'User\ContactController@noteContact']);
    Route::post('getNoteContact',               ['as' =>'user.contact.getNoteContact',      'uses' =>'User\ContactController@getNoteContact']);
    Route::post('searchNoteContent',            ['as' =>'user.contact.searchNoteContent',   'uses' =>'User\ContactController@searchNoteContent']);
    Route::get('project/{id}/{id1}',            ['as' =>'user.project',                     'uses' =>'User\ProjectController@project']);
    Route::get('add-project/{id}',              ['as' =>'user.project.add',                 'uses' =>'User\ProjectController@add']);
    Route::post('addProject',                   ['as' =>'user.project.addProject',          'uses' =>'User\ProjectController@addProject']);
    Route::post('editProjectSection',           ['as' =>'user.project.editProjectSection',  'uses' =>'User\ProjectController@editProjectSection']);
    Route::post('addZones',                     ['as' =>'user.project.addZones',            'uses' =>'User\ProjectController@addZones']);
    Route::post('editZones',                    ['as' =>'user.project.editZones',            'uses' =>'User\ProjectController@editZones']);
    Route::post('editZonesStore',               ['as' =>'user.project.editZonesStore',       'uses' =>'User\ProjectController@editZonesStore']);
    Route::get('add-quote/{id}/{id1}',          ['as' =>'user.project.addQuote',             'uses' =>'User\ProjectController@addQuote']);
    Route::get('quote/{id}/{id1}/{id2}',        ['as' =>'user.project.quote',                'uses' =>'User\ProjectController@quote']);
    Route::get('delete-quote/{id}/{slug}',      ['as' =>'user.project.deleteQuote',          'uses' =>'User\ProjectController@deleteQuote']);
    Route::get('delete-project/{id}/{slug}',    ['as' =>'user.project.deleteProject',        'uses' =>'User\ProjectController@deleteProject']);
    Route::post('storeQuote',                   ['as' =>'user.project.storeQuote',           'uses' =>'User\ProjectController@storeQuote']);
    Route::any('deleteZone/{id}',               ['as' =>'user.project.deleteZone',           'uses' =>'User\ProjectController@deleteZone']);
    Route::get('add-company',                   ['as' =>'user.company.addCompany',           'uses' =>'User\CompanyController@addCompany']);
    Route::post('storeCompany',                 ['as' =>'user.company.storeCompany',         'uses' =>'User\CompanyController@storeCompany']);
    Route::get('edit-company/{id}',             ['as' =>'user.company.editCompany',           'uses' =>'User\CompanyController@editCompany']);



Route::group(['prefix' => 'admin'], function () {

    Route::get('/',                         ['as' => 'admin.auth',                  'uses' => 'Admin\AuthController@index']);
    Route::get('login',                     ['as' => 'admin.auth.login',            'uses' => 'Admin\AuthController@login']);
    Route::post('doLogin',                  ['as' => 'admin.auth.doLogin',          'uses' => 'Admin\AuthController@doLogin']);
    Route::get('logout',                    ['as' => 'admin.auth.logout',           'uses' => 'Admin\AuthController@logout']);
    Route::get('dashboard',                 ['as' => 'admin.dashboard',             'uses' => 'Admin\DashboardController@index']);
    Route::get('profile',                   ['as' => 'admin.profile',               'uses' => 'Admin\ProfileController@index']);
    Route::post('profilestore',             ['as' => 'admin.profilestore',          'uses' => 'Admin\ProfileController@store']);

    Route::group(['prefix' => 'note-type'], function () {
        Route::get('/',           ['as' => 'admin.noteType',            'uses' => 'Admin\NoteTypeController@index']);
        Route::get('create',      ['as' => 'admin.noteType.create',      'uses' => 'Admin\NoteTypeController@create']);
        Route::post('store',      ['as' => 'admin.noteType.store',       'uses' => 'Admin\NoteTypeController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.noteType.edit',        'uses' => 'Admin\NoteTypeController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.noteType.delete',      'uses' => 'Admin\NoteTypeController@delete']);
    });
    Route::group(['prefix' => 'note'], function () {
        Route::get('/',           ['as' => 'admin.note',             'uses' => 'Admin\NoteController@index']);
        Route::get('create',      ['as' => 'admin.note.create',      'uses' => 'Admin\NoteController@create']);
        Route::post('store',      ['as' => 'admin.note.store',       'uses' => 'Admin\NoteController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.note.edit',        'uses' => 'Admin\NoteController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.note.delete',      'uses' => 'Admin\NoteController@delete']);
    });
    Route::group(['prefix' => 'note-commType'], function () {
        Route::get('/',           ['as' => 'admin.noteCommType',             'uses' => 'Admin\NoteCommTypeController@index']);
        Route::get('create',      ['as' => 'admin.noteCommType.create',      'uses' => 'Admin\NoteCommTypeController@create']);
        Route::post('store',      ['as' => 'admin.noteCommType.store',       'uses' => 'Admin\NoteCommTypeController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.noteCommType.edit',        'uses' => 'Admin\NoteCommTypeController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.noteCommType.delete',      'uses' => 'Admin\NoteCommTypeController@delete']);
    });
    Route::group(['prefix' => 'note-status'], function () {
        Route::get('/',           ['as' => 'admin.noteStatus',             'uses' => 'Admin\NoteStatusController@index']);
        Route::get('create',      ['as' => 'admin.noteStatus.create',      'uses' => 'Admin\NoteStatusController@create']);
        Route::post('store',      ['as' => 'admin.noteStatus.store',       'uses' => 'Admin\NoteStatusController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.noteStatus.edit',        'uses' => 'Admin\NoteStatusController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.noteStatus.delete',      'uses' => 'Admin\NoteStatusController@delete']);
    });
    Route::group(['prefix' => 'square'], function () {
        Route::get('/',           ['as' => 'admin.square',             'uses' => 'Admin\SquareController@index']);
        Route::get('create',      ['as' => 'admin.square.create',      'uses' => 'Admin\SquareController@create']);
        Route::post('store',      ['as' => 'admin.square.store',       'uses' => 'Admin\SquareController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.square.edit',        'uses' => 'Admin\SquareController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.square.delete',      'uses' => 'Admin\SquareController@delete']);
    });
    Route::group(['prefix' => 'temp'], function () {
        Route::get('/',           ['as' => 'admin.temp',             'uses' => 'Admin\TempController@index']);
        Route::get('create',      ['as' => 'admin.temp.create',      'uses' => 'Admin\TempController@create']);
        Route::post('store',      ['as' => 'admin.temp.store',       'uses' => 'Admin\TempController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.temp.edit',        'uses' => 'Admin\TempController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.temp.delete',      'uses' => 'Admin\TempController@delete']);
    });
    Route::group(['prefix' => 'velocity'], function () {
        Route::get('/',           ['as' => 'admin.velocity',             'uses' => 'Admin\VelocityController@index']);
        Route::get('create',      ['as' => 'admin.velocity.create',      'uses' => 'Admin\VelocityController@create']);
        Route::post('store',      ['as' => 'admin.velocity.store',       'uses' => 'Admin\VelocityController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.velocity.edit',        'uses' => 'Admin\VelocityController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.velocity.delete',      'uses' => 'Admin\VelocityController@delete']);
    });
    Route::group(['prefix' => 'payment'], function () {
        Route::get('/',           ['as' => 'admin.payment',             'uses' => 'Admin\PaymentController@index']);
        Route::get('create',      ['as' => 'admin.payment.create',      'uses' => 'Admin\PaymentController@create']);
        Route::post('store',      ['as' => 'admin.payment.store',       'uses' => 'Admin\PaymentController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.payment.edit',        'uses' => 'Admin\PaymentController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.payment.delete',      'uses' => 'Admin\PaymentController@delete']);
    });
    Route::group(['prefix' => 'type'], function () {
        Route::get('/',           ['as' => 'admin.type',             'uses' => 'Admin\TypeController@index']);
        Route::get('create',      ['as' => 'admin.type.create',      'uses' => 'Admin\TypeController@create']);
        Route::post('store',      ['as' => 'admin.type.store',       'uses' => 'Admin\TypeController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.type.edit',        'uses' => 'Admin\TypeController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.type.delete',      'uses' => 'Admin\TypeController@delete']);
    });
    Route::group(['prefix' => 'project'], function () {
        Route::get('/',           ['as' => 'admin.project',             'uses' => 'Admin\ProjectController@index']);
        Route::get('create',      ['as' => 'admin.project.create',      'uses' => 'Admin\ProjectController@create']);
        Route::post('store',      ['as' => 'admin.project.store',       'uses' => 'Admin\ProjectController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.project.edit',        'uses' => 'Admin\ProjectController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.project.delete',      'uses' => 'Admin\ProjectController@delete']);
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/',           ['as' => 'admin.user',             'uses' => 'Admin\UserController@index']);
        Route::get('create',      ['as' => 'admin.user.create',      'uses' => 'Admin\UserController@create']);
        Route::post('store',      ['as' => 'admin.user.store',       'uses' => 'Admin\UserController@store']);
        Route::get('edit/{id}',   ['as' => 'admin.user.edit',        'uses' => 'Admin\UserController@edit']);
        Route::get('delete/{id}', ['as' => 'admin.user.delete',      'uses' => 'Admin\UserController@delete']);
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/',                                 ['as' => 'admin.contact',                       'uses' => 'Admin\ContactController@index']);
        Route::get('contact-view/{id}',                 ['as' => 'admin.contact.view',                  'uses' => 'Admin\ContactController@view']);
        Route::get('delete/{id}',                       ['as' => 'admin.contact.delete',                'uses' => 'Admin\ContactController@delete']);
        Route::get('delete-project/{id}/{slug}',        ['as' => 'admin.contact.deleteProject',         'uses' => 'Admin\ContactController@deleteProject']);
        Route::get('delete-quote/{id}/{slug}',          ['as' =>'admin.contact.deleteQuote',            'uses' => 'Admin\ContactController@deleteQuote']);
        Route::get('project/{id}/{id1}',                ['as' =>'admin.contact.project',                'uses' => 'Admin\ContactController@project']);
        Route::get('quote/{id}/{id1}/{id2}',            ['as' =>'admin.contact.quote',                  'uses' => 'Admin\ContactController@quote']);
        Route::get('delete-deleteZone/{id}',            ['as' =>'admin.contact.deleteZone',             'uses' => 'Admin\ContactController@deleteZone']);

    });

});