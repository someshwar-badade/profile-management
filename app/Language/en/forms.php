<?php
return [
    'contactUs' => [
        'formHeading' => 'Contact Form',
        'successMessage' => 'Thank you for contacting us.',
        'fullName' => [
            'label' => 'Full Name',
            'placeholder' => 'Enter your Full Name...',
            'errorRequired' => 'Please enter your Full Name.',
            'errorMinlength' => 'The entered name is too short.'

        ],
        'emailAddress' => [
            'label' => 'Email Address',
            'placeholder' => 'Enter your email...',
            'errorRequired' => 'Please enter your Email Address.',
            'errorEmail' => 'Please enter a valid Email Address.'
        ],
        'mobile' => [
            'label' => 'Mobile Number',
            'placeholder' => 'Enter your mobile number...',
            'errorRequired' => 'Please enter your mobile number.',
            'errorMinlength' => 'Please enter valid Mobile number.',
            'errorNumeric' => 'The mobile number must contain only numbers.'
        ],
        'otp' => [
            'label' => 'OTP',
            'placeholder' => 'OTP',
            'errorRequired' => 'Please enter OTP.',
            'errorInvalid' => "Invalid OTP",
            'errorNumeric' => 'The OTP field must contain only numbers.',
            'otpSendScuccess' => 'OTP has been sent to your mobile number.'
        ],
        'message' => [
            'label' => 'Message',
            'placeholder' => 'Enter your message...',
            'errorRequired' => 'Please enter your message.'
        ],
        'submitBtn' => [
            'label' => 'Submit'
        ]
    ],
    'register' => [
        'formHeading' => 'Create New Account',
        'successMessage' => 'Registered successfully.',
        'user_type' => [
            'label' => 'user_type',
            'errorRequired' => 'Please select User Type',
        ],
        'fname' => [
            'label' => 'First Name',
            'placeholder' => 'First Name',
            'errorRequired' => 'Please enter First Name',

        ],
        'lname' => [
            'label' => 'Last Name',
            'placeholder' => 'Last Name',
            'errorRequired' => 'Please enter Last Name.',
        ],
        'email' => [
            'label' => 'Email Address',
            'placeholder' => 'Email Address',
            'errorRequired' => 'Please enter Email Address.',
            'errorEmail' => 'Please enter a valid Email Address.',
            'errorUnique' => 'This Email has been taken by another account.'
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Enter Password',
            'errorRequired' => 'Please enter Password.',
            'errorMinlength' => 'The entered password is too short.'
        ],
        'confirm_password' => [
            'label' => 'Confirm Password',
            'placeholder' => 'Re-Type Password',
            'errorEqualto' => 'Password is not matched.',
        ],

        'submitBtn' => [
            'label' => 'Register'
        ],
        'footerText_1' => 'Already have an account?',
        'footerText_2' => 'Login',
        // 'sideText'=>'Organic food products are grown under a system of agriculture without the use of harmful chemical fertilizers and pesticides with an environmentally and socially responsible approach.'

    ],
    'login' => [
        'formHeading' => 'Welcome',
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Email',
            'errorRequired' => 'Please enter your Email.',
            'errorMinlength' => 'Please enter a valid Email .',
            // 'errorNumeric'=> 'The Mobile field must contain only numbers.',
        ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Password',
            'errorRequired' => 'Please enter your Password.',
            'errorMinlength' => 'The entered password is too short.',
            'errorInvalid' => 'Invalid password.'
        ],
        // 'otp'=>[
        //     'label'=>'OTP',
        //     'placeholder'=>'OTP',
        //     'errorRequired'=>'Please enter OTP.',
        //     'errorInvalid'=>"Invalid OTP",
        //     'errorNumeric'=> 'The OTP field must contain only numbers.',
        //     'otpSendScuccess' =>'OTP has been sent to your mobile number.'
        // ],
        'submitBtn' => [
            'label' => 'Login'
        ],
        // 'requestOTPBtn'=>[
        //     'label'=>'Request OTP'
        // ],
        // 'or'=>'OR',
        'forgotPassword' => 'Forgot Password',
        'footerText_1' => "Don't have an account?",
        'footerText_2' => 'Register Now',
    ],
    'forgotpassword' => [
        'formHeading' => 'Forgot Password',
        'successMessage' => 'Your password has been changed successfully.',
        'email' => [
            'label' => 'Email',
            'placeholder' => 'Email',
            'errorRequired' => 'Please enter your Email.',
            'errorMinlength' => 'Please enter a valid Email .',
        ],
        // 'mobile'=>[
        //     'label'=>'Mobile number',
        //     'placeholder'=>'Mobile number',
        //     'errorRequired'=>'Please enter your Mobile.',
        //     'errorMinlength'=> 'Please enter a valid Mobile number.',
        //     'errorNumeric'=> 'The Mobile field must contain only numbers.',            
        //     'errorInvalid'=> 'Mobile number is not registered.'
        // ],
        'password' => [
            'label' => 'Password',
            'placeholder' => 'Enter your Password...',
            'errorRequired' => 'Please enter your Password.',
            'errorMinlength' => 'The entered password is too short.',
            'errorInvalid' => 'Invalid password.'
        ],
        // 'otp'=>[
        //     'label'=>'OTP',
        //     'placeholder'=>'OTP',
        //     'errorRequired'=>'Please enter OTP.',
        //     'errorInvalid'=>"Invalid OTP",
        //     'errorNumeric'=> 'The OTP field must contain only numbers.',
        //     'otpSendScuccess' =>'OTP has been sent to your mobile number.'
        // ],
        'submitBtn' => [
            'label' => 'Submit'
        ],
        // 'requestOTPBtn'=>[
        //     'label'=>'Request OTP'
        // ]

    ],

    'addbreed' => [
        'formHeading' => 'Add/Edit Breed Type',
        'note' => 'Note:- Application is designed to manage Goat and sheep. However, only Goat is enabled to use. Contact us via email or call to enable Sheep or both (Goat and Sheep).',
        
    ]

];
