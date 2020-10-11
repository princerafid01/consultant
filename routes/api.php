<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    // Geeks
    Route::post('register', 'API\AuthController@register');
    Route::post('login', 'API\AuthController@login');
    Route::get('refresh', 'API\AuthController@refresh');

    // Users
    Route::post('user/register', 'API\UserController@register');
    Route::post('user/login', 'API\UserController@login');
    Route::get('user/refresh', 'API\UserController@refresh');

    Route::get('tags', 'API\TagController@index');
    Route::get('categories', 'API\CategoryController@index');
    Route::get('geeks', 'API\GeekController@index');
    Route::get('geeks/{username}', 'API\GeekController@findByUsername');
    Route::get('homepage/content', 'Admin\HomepageContentController@get');

    Route::get('/refunds', 'API\PaymentController@all_refunds');


    Route::get('users', 'API\UserController@users');

    Route::any('bbb/recordings', 'API\BbbController@recording')->name('bbb.recordings');

    Route::post('forgot_password', 'API\AuthController@forgot_password');


    Route::group(['middleware' => 'auth:api','namespace' => 'API'], function () {
        Route::get('geek', 'AuthController@user');
        Route::get('user', 'UserController@user');

        Route::post('addToFav', 'UserController@add_to_favourite');

        Route::post('logout', 'AuthController@logout');
        Route::post('avatarUpload', 'ImageController@upload_avatar');
        Route::post('uploadImage', 'ImageController@upload');
        Route::post('geeks/{user}', 'AuthController@edit_profile');
        Route::post('posts', 'PostController@store');
        Route::post('certifications', 'CertificateController@store');
        Route::post('update/booking', 'BookingController@update');
        Route::post('questionAnswer', 'QuestionController@answer');
        Route::post('questionAsk', 'QuestionController@ask');
        Route::post('earningsSet', 'EarningController@set');
        Route::post('reviews', 'ReviewController@store');
        Route::get('get_notification_number', 'NotificationController@get_number');
        Route::get('mark_read/{notification}', 'NotificationController@mark_read');
        Route::get('mark_read_all', 'NotificationController@mark_read_all');

        Route::post('/request-refund', 'PaymentController@request_refund');
        Route::post('/refund', 'PaymentController@refund');
        Route::post('/refund/reject', 'PaymentController@refundReject');

        Route::get('questions/delete/{question}', 'QuestionController@delete_message');
        Route::get('notifications/delete/{notification}', 'NotificationController@delete_notification');





        Route::get('certificates/{certificate}', 'CertificateController@destroy');
        Route::get('bbb/meetings', 'BbbController@is_meeting_ready')->name('bbb.meetings.is_ready');
        Route::post('bbb/meetings/recordings', 'BbbController@get_recordings')->name('bbb.meetings.recordings');


        Route::get('get_withdraw_requests', 'WithdrawRequestController@get')->name('withdraw.request.get');
        Route::post('withdraw_request', 'WithdrawRequestController@withdraw_request')->name('withdraw.request');

        Route::post('payment/makePayment', 'PaymentController@makePayment');

        // payapl
        Route::post('checkout-paypal', 'PaymentController@createPayment');
        Route::post('execute-paypal', 'PaymentController@executePaypal');
    });
});
Route::post('sociallogin/{provider}/{role}', 'API\SocialLoginController@SocialSignup');
