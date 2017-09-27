<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as'=> '/', 'uses'=> 'WapIndexController@index'));
Route::get('goods', array('as'=> 'goods', 'uses'=> 'WapGoodsController@goods'));
Route::get('cart', array('as'=> 'cart', 'uses'=> 'WapGoodsController@cart'));