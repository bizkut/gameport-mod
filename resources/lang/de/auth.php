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

    'login' => 'Sign in',
    'login_facebook' => 'Sign in with Facebook',
    'login_twitter' => 'Sign in with Twitter',
    'login_google' => 'Sign in with Google',
    'login_or' => 'or',
    'username' => 'Username',
    'email' => 'eMail Adress',
    'password' => 'Password',
    'password_confirmation' => 'Confirm Password',
    'password_forgot' => 'Forgot Your Password?',
    'remember_me' => 'Remember me',
    'no_account_question' => "Don't have an account?",
    'no_account_question_create' => 'Create one for free!',
    'create_account' => 'Create Account',
    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'unknown' => 'An unknown error occurred',

    'welcome_back' => 'Welcome back, :User_name!',
    'see_you' => 'See you soon!',
    'deactivated' => 'Your Account has been deactivated!',

    'confirmation' => [
        'already_confirmed' => 'Your account is already confirmed.',
        'confirm' => 'Confirm your account!',
        'created_confirm' => 'Your account was successfully created. We have sent you an e-mail to confirm your account.',
        'mismatch' => 'Your confirmation code does not match.',
        'not_found' => 'That confirmation code does not exist.',
        'resend' => 'Your account is not confirmed. Please click the confirmation link in your e-mail, or <a href="' . route('frontend.auth.account.confirm.resend', ':user_id') . '">click here</a> to resend the confirmation e-mail.',
        'success' => 'Your account has been successfully confirmed!',
        'resent' => 'A new confirmation e-mail has been sent to the address on file.',
    ],

    'reset' => [
        'reset_button' => 'Reset Password',
        'password' => 'Passwords must be at least six characters and match the confirmation.',
        'reset' => 'Your password has been reset!',
        'sent' => 'We have e-mailed your password reset link!',
        'token' => 'This password reset token is invalid.',
        'user' => "We can't find a user with that e-mail address.",
    ],

];
