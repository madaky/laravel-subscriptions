<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Route::get('package','PlanController@index')->name('rolecreation');
Route::post('package','PlanController@create')->name('rolepcreation');

Route::get('process','PlanController@getPayment')->name('processPayment');
Route::get('failure','PlanController@failedPayment')->name('paymentfailed');
