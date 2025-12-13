<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'sign_up' => 'Sign up your account',
    'sub_1' => 'And start your journey at GoodOver',
    'agree_text' => 'By proceeding, you agree to GoodOver\'s :privacy_link and :terms_link.',
    'privacy_policy' => 'Privary Policy',
    'terms' => 'Terms and Conditions',
    'account_reminder' => 'Already have an account?',

    'login' => 'Login to your account',
    'sub_2' => 'And continue your journey at GoodOver',
    'register_reminder' => 'Doesn\'t have an account?',

    'registerMessages' => [
        'required'    => 'All fields are required.',
        'email'       => 'Email format is invalid (must contain "@").',
        'min'         => ':Attribute must be at least :min characters.',
        'date_format' => 'Time format must be HH:MM.',
        'mimes'       => 'File must be a jpg, jpeg, or png.',
        'in'          => 'Invalid selected value.',
        'alpha_num'   => ':Attribute may only contain letters and numbers.',
        'unique'      => ':Attribute have already been taken',
    ],

    'attributes' => [
        // user register
        'email'    => 'Email',
        'username' => 'Username',
        'password' => 'Password',

        // seller register
        'name'         => 'Store name',
        'address'      => 'Store address',
        'contact'      => 'Store contact',
        'location'     => 'Store location',
        'opening_time' => 'Opening time',
        'closing_time' => 'Closing time',
        'image_path'   => 'Store profile image',
    ],
];
