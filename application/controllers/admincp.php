<?php

class admincp
{

    //Default func will be load when call to this controller
    public function index()
    {
        //Call to model 'login'
        Model::load('login');

//        Cache::enable(15);

        if (!isLogin()) {

            $alert = '';
            //If click onto login button
            if (Request::has('btnLogin')) {

                if (isUser(Request::get('username'), Request::get('password'))) {
                    Redirect::to('admincp');
                } else {
                    $alert = '<div class="alert alert-danger">Wrong. Check login info again!</div>';
                }
            }

            View::make('login', array('alert' => $alert));
        } else {
            echo 'Loggedin. Welcome to admincp';
        }


    }
}

?>