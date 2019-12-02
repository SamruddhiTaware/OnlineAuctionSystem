<?php

class loggedInUser
{
    public $email = NULL;
    public $hash_pw = NULL;
    public $user_id = NULL;

    public $first_name = NULL;
    public $last_name = NULL;
    public $username = NULL;
    public $member_since = NULL;
    public $role = NULL;

    //you can defined a construct here {}
    //you can define a some private functions here like
    // update last sign up - or modify username / password etc.

    //Logout
    public function userLogOut()
    {
        destroySession("ThisUser");
    }
}