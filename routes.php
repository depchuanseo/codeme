<?php

Route::get('', 'welcome');

Route::get('hi', function(){

});


Route::pattern('all', '.*?');
Route::get('{all}', function () {
    View::make('page_not_found');
});

?>