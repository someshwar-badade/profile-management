<?php 
return [
    'heading'=>'MARUTI ORGANIC VOCAL PROFILE',
    'profileId'=>'Profile ID',
    'joiningDate'=>'Joining Date',
    'profileStatus'=>'Profile Status',
    'profilePlan'=>'Profile Plan',
    'personal'=>[
        'heading'=>'Personal Details',
        'success'=>'Personal Details has been updated.',
        'firstName'=>[
            'label'=>'First Name',
            'placeholder'=>'Enter First Name...',
            'errorRequired'=>'Please enter First Name.',
            
        ],
        'middleName'=>[
            'label'=>'Middle Name',
            'placeholder'=>'Enter Middle Name...',
            'errorRequired'=>'Please enter Middle Name.',
            
        ],
        'lastName'=>[
            'label'=>'Last Name',
            'placeholder'=>'Enter Last Name...',
            'errorRequired'=>'Please enter Last Name.',
        ],
        'emailAddress'=>[
            'label'=>'Email Address',
            'placeholder'=>'Enter Email address...',
            'errorRequired'=>'Please enter Email Address.',
            'errorEmail'=> 'Please enter a valid Email Address.',
            'errorUnique'=> 'This Email has been taken by another account.'
        ],
        'mobile'=>[
            'label'=>'Mobile',
            'placeholder'=>'Enter Mobile...',
            'errorRequired'=>'Please enter Mobile.',
            'errorMinlength'=> 'Please enter valid Mobile number.',
            'errorUnique'=> 'This Mobile number has been taken by another account.',
            'errorNumeric'=> 'The Mobile field must contain only numbers.',
        ],
        'otherPhoneNumber'=>[
            'label'=>'Other Phone Number',
            'errorNumeric'=> 'The Mobile field must contain only numbers.',
        ],
        'joiningDate'=>[
            'label'=>'Joining Date',
        ],
        'profilePlan'=>[
            'label'=>'Profile Plan',
        ],
        'profileStatus'=>[
            'label'=>'Profile Status',
        ],
        'gender'=>[
            'label'=>'Gender',
            'male'=>'Male',
            'female'=>'Female'
        ],
        'referralId'=>[
            'label'=>'Referral ID',
            'placeholder'=>'Type here Referral ID/Name'
        ],
        'maritalStatus'=>[
            'label'=>'Marital Status',
            'options'=>[
                'Single'=>'Single',
                'Married'=>'Married',
                'Widowed'=>'Widowed',
                'Divorced'=>'Divorced',
            ]
        ],
        'dob'=>[
            'label'=>'DOB',
        ],
    ],
    'bank'=>[
        'heading'=>'Bank Details',
        'success'=>'Bank Details has been updated.',
        'bankName'=>[
            'label'=>'Bank Name',
            'errorRequired'=>'Please enter Bank Name.',
        ],
        'accountName'=>[
            'label'=>'Account Name',
            'errorRequired'=>'Please enter Account Name.',
        ],
        'accountNumber'=>[
            'label'=>'Account Number',
            'errorRequired'=>'Please enter Account Number.',
        ],
        'ifsc'=>[
            'label'=>'IFSC Code',
            'errorRequired'=>'Please enter IFSC Code.',
        ],
        'photoProof'=>[
            'label'=>'Cheque / Passbook Photo',
            'errorValid'=>'Please select a valid file.',
        ], 
    ],
    'nominee'=>[
        'heading'=>'Nominee Details',
        'success'=>'Nominee Details has been updated.',
        'nomineeName'=>[
            'label'=>'Nominee Name',
            'errorRequired'=>'Please enter Nominee Name.',
        ],
        'nomineeRelation'=>[
            'label'=>'Nominee Relation',
            'errorRequired'=>'Please enter Nominee Relation.',
        ],
        'nomineeMobile'=>[
            'label'=>'Nominee Mobile',
            'errorRequired'=>'Please enter Nominee Mobile.',
            'errorMinlength'=> 'Please enter valid Mobile number.',
            'errorNumeric'=> 'The Mobile field must contain only numbers.',
        ],
        'nomineeAddress'=>[
            'label'=>'Nominee Address',
            'errorRequired'=>'Please enter Nominee Address.',
        ],
    ],
    'address'=>[
        'heading'=>'Address Details',
        'success'=>'Address Details has been updated.',
        'addressLine1'=>[
            'label'=>'Address Line 1',
            'errorRequired'=>'Please enter Address Line 1.',
        ],
        'addressLine2'=>[
            'label'=>'Address Line 2',
            'errorRequired'=>'Please enter Address Line 2.',
        ],
        'city'=>[
            'label'=>'City',
            'errorRequired'=>'Please enter City Name.',
        ],
        'state'=>[
            'label'=>'State',
            'errorRequired'=>'Please enter State Name.',
        ],
        'country'=>[
            'label'=>'Country',
            'errorRequired'=>'Please enter Country Name.',
        ],
        'pincode'=>[
            'label'=>'Pin Code',
            'errorRequired'=>'Please enter Pin Code.',
        ],
    ],
    'kyc'=>[
        'heading'=>'KYC',
        'pan'=>'PAN',
        'note'=>'Note:Upload file max size 1024kb.',
        'panSuccess'=>'PAN Details has been updated.',
        'aadharSuccess'=>'Aadhar Details has been updated.',
        'panNumber'=>[
            'label'=>'PAN Number',
            'errorRequired'=>'Please enter PAN Number.',
            'errorValid'=>'Please enter valid PAN Number.',
        ],
        'panIdProof'=>[
            'label'=>'PAN ID Proof',
            'errorRequired'=>'Please enter PAN Number.',
            'errorValid'=>'Please select a valid file.',
        ],
        'aadhar'=>'Aadhar',
        'aadharNumber'=>[
            'label'=>'Aadhar Number',
            'errorRequired'=>'Please enter Aadhar Number.',
            'errorValid'=>'Please enter valid Aadhar Number.',
        ],
        'aadharIdProof'=>[
            'label'=>'Aadhar ID Proof',
            'errorRequired'=>'Please enter Aadhar Number.',
            'errorValid'=>'Please select a valid file.',
        ], 
       
        
    ],
    'settings'=>[
        'heading'=>'Settings',
        'password'=>'Password',
        
        'passSuccess'=>'Password has been updated.',
        'currentPassword'=>[
            'label'=>'Current Password',
            'placeholder'=>'',
            'errorRequired'=>'Please enter Current Password.',
            'errorMinlength'=> 'The entered password is too short.',
            'errorValid'=> 'Please enter valid password.'
        ],
        'newPassword'=>[
            'label'=>'New Password',
            'placeholder'=>'',
            'errorRequired'=>'Please enter New Password.',
            'errorMinlength'=> 'The entered password is too short.'
        ],
        'confirmPassword'=>[
            'label'=>'Confirm Password',
            'placeholder'=>'Confirm Password',
            'errorEqualto'=>'Password is not matched.',
        ],
       
        'note'=>'Note:Upload file max size 200kb.',
        'profilePhotoSuccess'=>'Profile Photo has been updated.',
        'profilePhoto'=>[
            'label'=>'Profile Photo',
            'errorRequired'=>'Please select Profile Photo.',
            'errorValid'=>'Please select a valid file.',
        ]
    ],
    'referral'=>[
        'heading'=>'Referral Details',
        'referralId'=>'Referral Id',
        'name'=>'Name',
        'mobile'=>'mobile',
        'email'=>'Email',

    ],
    'buttons'=>[
        'edit'=>'Edit',
        'viewDocument'=>'View Document',
        'save'=>'Save',
        'cancel'=>'Cancel'
    ]
    ];
