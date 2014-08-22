<?php

//Load codeme core
require('codeme_start.php');


/* Codeme PHP Framework v1.0 - Write & Develop by [Minh Tien] - Email: safeservicejt@gmail.com
 * You will create & define route here. Route will check then load controller which you create.
 *
 *
 *
 */



Route::get('', 'welcome');

Route::get('test-cache', function () {

    Cache::enable(10); //Expires = 10 seconds

    echo 'Content of page';

});

Route::pattern('all', '.*?');
Route::get('{all}', function () {
    View::make('page_not_found');
});


?>