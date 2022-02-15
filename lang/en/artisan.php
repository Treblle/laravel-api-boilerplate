<?php

declare(strict_types=1);

return [

    'create_user' => [
        'description' => 'Create a new user',
        'dialogs'     => [
            'confirm_before_executing' => 'Do you want to proceed?',
        ],
        'alerts' => [
            'confirmation' => 'User created!',
        ],
        'questions' => [
            'name'     => 'What is the name?',
            'email'    => 'What is the email?',
            'password' => 'What is the password?',
        ],
    ],

];
