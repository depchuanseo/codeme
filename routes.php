<?php

Database::connect();

Route::get('', 'welcome');

Route::get('hi', function(){

// $users=new DatabaseORM('users');

// // $users->username='admin';
// // $users->password='minhtien';
// // $users->fullname='Tien';

// // $users->InsertOnSubmit();

// $users->where('userid',162);

// $users->username = 'testtest'; 

// $users->password = md5('fgfg');

// $users->SubmitChanges();

// passthru("mysqldump -u root 2014_codeme_test > d:\aaaa.sql");
});


Route::pattern('all', '.*?');
Route::get('{all}', function () {
    View::make('page_not_found');
});

?>