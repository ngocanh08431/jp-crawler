<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/crawl', function() {
    $crawler = Goutte::request('GET', 'http://japanesetest4you.com/flashcard/category/learn-japanese-vocabulary/learn-japanese-n1-vocabulary/page/3/');
    
    
    $crawler->filter('div > p > img')->each(function ($node) {
      $img_url = (($node->extract(array('src'))[0]));
      echo "<img src ='".$img_url."'>";
    });
    // dump($crawler);
    return view('welcome');
});
