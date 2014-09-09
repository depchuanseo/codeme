<?php

//Load codeme core
require('codeme_start.php');


/* Codeme PHP Framework v1.0 - Write & Develop by [Minh Tien] - Email: safeservicejt@gmail.com
 * You will create & define route here. Route will check then load controller which you create.
 *
 *
 *
 */


//Connect to database
//Database::connect('codeme'); //Default db shortname is 'default', you can type your custom db shortname


Route::get('', 'welcome');


Route::pattern('all', '.*?');
Route::get('{all}', function () {
    View::make('page_not_found');
});


?>