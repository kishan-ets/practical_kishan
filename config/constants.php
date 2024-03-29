<?php

use Carbon\Carbon;

return [

    'messages' => [
        'user' => [
            'invalid' => 'Invalid credentials',
        ],
        'success' => 'Success',
        'logout' => 'You have been Successfully logged out!',
        'registration_success'=>'Registration Successfully',
        'delete_success'=>'Record Delted Successfully',
        'something_wrong' => 'Something went wrong.',
        'invalid_old_password' => "Invalid old password.",
        'change_passowrd_success' => 'Password Changed Succssfully',
        'invalid_email' => 'Invalid Email',
        'forgotpassword_success'=>'Password reset instructions has been sent to your email. Please check your inbox/spam',
        'role_success' => 'New Role Added Successfully',
        'permisssion_success' => 'New Permission Added Successfully',
        'role_permisssion_success' => 'New Permission Assign for Role',
        'role_permisssion_alreday' => 'This Role Permission  Already assigned',
        'file_csv_error'=>'please upload csv file',
    ],

    'permission' => [
        'user_has_not_permission' => "You don\'t have permission to this functionality",
    ],

    'validation_codes' => [
        'unauthorized' => 401,
        'forbidden' => 403,
        'unprocessable_entity' => 422,
        'unassigned' => 427,
        'ok' => 200,
    ],

    'models'=>[
        'user_model' => 'user',
    ],

    'import_dir_path'=>[
        'user_dir_path' => 'import/user/',
    ],

    'image' => [
        'dir_path' => '/storage/',
    ],

    'role'=>[
        'apply_role' => '1',
    ],

    'file' => [
        'name' => Carbon::now('Asia/Kolkata')->format('d_m_Y') . '_' . Carbon::now('Asia/Kolkata')->format('g_i_a'),
    ],
];
