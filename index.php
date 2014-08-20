<?php

//Load codeme core
require('codeme_start.php');


/* Codeme PHP Framework v1.0 - Write & Develop by [Minh Tien] - Email: safeservicejt@gmail.com
 * You will create & define route here. Route will check then load controller which you create.
 *
 *
 *
 */
// Call to func view() of Controller Example
Route::get('view-1','example@view');

Route::get('view-2',function(){

    $text="Anh nho ems nhieu lam\r\n\r\n\r\n\r\nTest line 2\r\n\r\n\r\n\r\n Test line 3\r\n\r\nTst line 4\r\nTst line 5";

//    preg_match_all('/([a-zA-Z0-9\-\_\.\'\"\{\}\[\]\:\;\,\<\>\?\/\!\@\#\$\%\^\&\*\(\)\+\=]+)[\s]/i',$text,$matches);
   $parse=String::trimLines($text);

    print_r($parse);


});


//Call to func a() of controller example
Route::get('exam-1','example@a');
//Call to "example" controller, it will run function index() default.
Route::get('exam','example');

Route::pattern('all','.*?');
Route::get('{all}',function(){
    echo 'Welcome!';
});


?>