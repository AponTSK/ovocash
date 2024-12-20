<?php

use Illuminate\Support\Facades\Route;

// Route::namespace('Auth')->group(function ()
// {
//     Route::middleware('admin.guest')->group(function ()
//     {
//         Route::controller('LoginController')->group(function ()
//         {
//             Route::get('/', 'showLoginForm')->name('login');
//             Route::post('/', 'login')->name('login');
//             Route::get('logout', 'logout')->middleware('admin')->withoutMiddleware('admin.guest')->name('logout');
//         });
//         // Admin Password Reset
//         Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function ()
//         {
//             Route::get('reset', 'showLinkRequestForm')->name('reset');
//             Route::post('reset', 'sendResetCodeEmail');
//             Route::get('code-verify', 'codeVerify')->name('code.verify');
//             Route::post('verify-code', 'verifyCode')->name('verify.code');
//         });

//         Route::controller('ResetPasswordController')->group(function ()
//         {
//             Route::get('password/reset/{token}', 'showResetForm')->name('password.reset.form');
//             Route::post('password/reset/change', 'reset')->name('password.change');
//         });
//     });
// });

Route::namespace('Agent\Auth')->prefix('agent')->name('agent.')->group(function ()
{
    // Route::middleware('agent.guest')->group(function ()
    // {
        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
        Route::post('check-agent', 'RegisterController@checkAgent')->name('checkAgent');
    // });
});

Route::namespace('Agent\Auth')->name('agent.')->middleware('agent.guest')->group(function ()
{
    Route::controller('LoginController')->group(function ()
    {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->middleware('agent')->withoutMiddleware('agent.guest')->name('logout');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function ()
    {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('ResetPasswordController')->group(function ()
    {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });

    // Route::controller('SocialiteController')->group(function ()
    // {
    //     Route::get('social-login/{provider}', 'socialLogin')->name('social.login');
    //     Route::get('social-login/callback/{provider}', 'callback')->name('social.login.callback');
    // });
});



Route::middleware('auth')->name('agent.')->group(function ()
{

    // Route::get('agent-data', 'Agent\AgentController@agentrData')->name('data');
    // Route::post('agent-data-submit', 'Agent\AgentController@agentDataSubmit')->name('data.submit');

    // //authorization
    // Route::middleware('registration.complete')->namespace('Agent')->controller('AuthorizationController')->group(function ()
    // {
    //     Route::get('authorization', 'authorizeForm')->name('authorization');
    //     Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
    //     Route::post('verify-email', 'emailVerification')->name('verify.email');
    //     Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
    //     Route::post('verify-g2fa', 'g2faVerification')->name('2fa.verify');
    // });

    // Route::middleware(['check.status', 'registration.complete'])->group(function ()
    // {

    //     Route::namespace('Agent')->group(function ()
    //     {

    //         Route::controller('UserController')->group(function ()
    //         {
    //             Route::get('dashboard', 'home')->name('home');
    //             Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');

    //             //2FA
    //             Route::get('twofactor', 'show2faForm')->name('twofactor');
    //             Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
    //             Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

    //             //KYC
    //             Route::get('kyc-form', 'kycForm')->name('kyc.form');
    //             Route::get('kyc-data', 'kycData')->name('kyc.data');
    //             Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

    //             //Report
    //             Route::any('deposit/history', 'depositHistory')->name('deposit.history');
    //             Route::get('transactions', 'transactions')->name('transactions');

    //             Route::post('add-device-token', 'addDeviceToken')->name('add.device.token');
    //         });

    //         //Profile setting
    //         Route::controller('ProfileController')->group(function ()
    //         {
    //             Route::get('profile-setting', 'profile')->name('profile.setting');
    //             Route::post('profile-setting', 'submitProfile');
    //             Route::get('change-password', 'changePassword')->name('change.password');
    //             Route::post('change-password', 'submitPassword');
    //         });


    //         // Withdraw
    //         Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function ()
    //         {
    //             Route::middleware('kyc')->group(function ()
    //             {
    //                 Route::get('/', 'withdrawMoney');
    //                 Route::post('/', 'withdrawStore')->name('.money');
    //                 Route::get('preview', 'withdrawPreview')->name('.preview');
    //                 Route::post('preview', 'withdrawSubmit')->name('.submit');
    //             });
    //             Route::get('history', 'withdrawLog')->name('.history');
    //         });

    //         //Send Money
    //         Route::controller('SendMoneyController')->group(function ()
    //         {
    //             Route::post('/search-agent', 'searchAgent')->name('search.agent');
    //             Route::get('/send-money', 'send')->name('send');
    //             Route::get('/create-send-money', 'createSendMoney')->name('create.send.money');
    //             Route::post('/process-send-money', 'processSendMoney')->name('send.money');
    //             //Route::get('/request-money', 'request')->name('request');
    //             Route::get('/send-money-preview/{id}', 'sendMoneyPreview')->name('send.money.preview');
    //             Route::post('/send-money-confirm/{id}', 'confirmSendMoney')->name('send.money.confirm');
    //             // Route::post('/request-money', 'requestMoney')->name('request.money');
    //             Route::get('money-requests',  'moneyRequests')->name('money.requests');
    //             Route::get('create-money-request',  'createMoneyRequest')->name('create.money.request');
    //             Route::post('store-money-request',  'storeMoneyRequest')->name('store.money.request');
    //         });
    //     });

    //     // Payment
    //     Route::prefix('deposit')->name('deposit.')->controller('Gateway\PaymentController')->group(function ()
    //     {
    //         Route::any('/', 'deposit')->name('index');
    //         Route::post('insert', 'depositInsert')->name('insert');
    //         Route::get('confirm', 'depositConfirm')->name('confirm');
    //         Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
    //         Route::post('manual', 'manualDepositUpdate')->name('manual.update');
    //     });
    // });
});