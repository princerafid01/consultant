<?php

use Illuminate\Support\Facades\Route;
use JoisarJignesh\Bigbluebutton\Facades\Bigbluebutton;

// Route::get('/w/{any?}', 'SpaController@worker')->where('any', '.*')->name('spa.worker');
// Route::get('/c/{any?}', 'SpaController@customer')->where('any', '.*')->name('spa.customer');



Route::prefix('admin')->group(function () {
    Route::get('/', 'Admin\DashboardController@index')->name('dashboard');

    Route::get('/geeks', 'Admin\ExpertController@index')->name('experts.index');
    Route::get('/geeks/all', 'Admin\ExpertController@geeks')->name('get.geeks');
    Route::get('/geeks/{user}', 'Admin\ExpertController@show')->name('view.geeks');
    Route::get('/geeks/{user}/status', 'Admin\ExpertController@status')->name('expert.status');

    Route::get('/categories', 'Admin\CategoryController@index')->name('categories.index');
    Route::post('/categories', 'Admin\CategoryController@store')->name('categories.store');
    Route::post('/categories/sub/{category}', 'Admin\CategoryController@storeSub')->name('categories.store.sub');
    Route::get('/categories/destroy/{category}', 'Admin\CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/{category}', 'Admin\CategoryController@update')->name('categories.update');
    Route::post('/categories/sub_edit/{category}', 'Admin\CategoryController@updateSubCat')->name('categories.sub.update');

    Route::get('/users', 'Admin\UserController@index')->name('users.index');
    Route::get('/users/all', 'Admin\UserController@users')->name('get.users');

    Route::get('/bookings', 'Admin\BookingController@index')->name('bookings.index');
    Route::get('/bookings/all', 'Admin\BookingController@bookings')->name('get.bookings');

    Route::get('/earnings', 'Admin\EarningController@index')->name('earnings.index');
    Route::get('/earnings/all', 'Admin\EarningController@earnings')->name('get.earnings');
    Route::get('/earnings/{withdraw}', 'Admin\EarningController@show')->name('view.earnings');
    Route::get('/earnings/reject/{withdraw}', 'Admin\EarningController@reject')->name('reject.earnings');
    Route::post('/earnings/confirmAttachment', 'Admin\EarningController@confirm_attachment')->name('confirm.attachment.earnings');
    Route::get('/earnings/confirm/{withdraw}', 'Admin\EarningController@confirm')->name('confirm.earnings');

    Route::get('/home-content', 'Admin\HomepageContentController@index')->name('homepage.content.index');
    Route::post('/home-content', 'Admin\HomepageContentController@store')->name('homepage.content.store');

    Route::get('/tags', 'Admin\TagController@index')->name('tags.index');
    Route::post('/tags', 'Admin\TagController@store')->name('tags.store');
    Route::post('/tags/update/{tag}', 'Admin\TagController@update')->name('tags.update');


    Route::get('/users/delete/{user}', 'Admin\UserController@delete_user')->name('user.delete');






    Auth::routes();
});
// Big Blue Button Starting Url
Route::get('/bbb/start', 'API\BbbController@create')->name('bbb.create');
Route::get('/bbb/join', 'API\BbbController@join')->name('bbb.join');

 // it will handle the redirection
Route::get('auth/{provider}/callback', function () {
    return 'Successful';
})->where('provider', '.*');
// Route::get('/bbb', function () {
//     dd(Bigbluebutton::getRecordings(['meetingID' => 'ce7c344db9ee2a374a601bc4e395fe4c943716b1'])->first());
// });

Route::get('/test-paypal', 'Admin\EarningController@paypalWithdraw');


Route::get('/{any?}', function () {
    return view('frontend.index');
})->where('any', '[\/\w\.-]*')->name('spa.website');
