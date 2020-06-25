
<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This value determines which of the following provider to use.
    | You can switch to a different driver at runtime.
    |
    */
    'default' => 'parsasms',

    /*
    |--------------------------------------------------------------------------
    | List of Drivers
    |--------------------------------------------------------------------------
    |
    | These are the list of drivers to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */
    'drivers' => [
        'parsasms' => [
            'apiUrl' => "http://api.smsapp.ir/v2/sms/",
            'apiKey' => "api_key",
            'sender' => "sender number",
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Drivers above.
    | You can create your own driver if you like and add the
    | config in the drivers array and the class to use for
    | here with the same name. You will have to extend
    | Alishojaeiir\Smschi\Drivers\Driver in your driver.
    |
    */
    'map' => [
        'asanpardakht' => \Alishojaeiir\Smschi\Drivers\ParsaSms\ParsaSms::class,
        
    ]
];
