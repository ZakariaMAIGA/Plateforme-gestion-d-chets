<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'comptes',// j'ai remplacer users par compte
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Next, you may define every authentication guard for your application.
    | Of course, a great default configuration has been defined for you
    | here which uses session storage and the Eloquent user provider.
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | Supported: "session"
    |
    */

    // 'guards' => [
    //     'web' => [
    //         'driver' => 'session',   // J'ai commente ca egalement en raison que j'ai commente pour le provider pour user
    //         'provider' => 'users',
    //     ],
    // ],
     
    'guards' => [
        'web' => [
            'driver' => 'session',   // J'ai commente ca egalement en raison que j'ai commente pour le provider pour user
            'provider' => 'comptes',
        ],
   // ],

    //Les differents guards ajoutes
    //'guards' => [
//   'compte' => [
//         'driver' => 'session',
//         'provider' => 'comptes',
//     ],

    'resident' => [
        'driver' => 'session',
        'provider' => 'comptes',
    ],
    'mairie' => [
        'driver' => 'session',
        'provider' => 'comptes',
    ],
    'entreprise' => [
        'driver' => 'session', 
        'provider' => 'comptes',
    ],
    'admin' => [
        'driver' => 'session',
        'provider' => 'comptes',
    ],
],


    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are actually retrieved out of your database or other storage
    | mechanisms used by this application to persist your user's data.
    |
    | If you have multiple user tables or models you may configure multiple
    | sources which represent each model / table. These sources may then
    | be assigned to any extra authentication guards you have defined.
    |
    | Supported: "database", "eloquent"
    |
    */

    // 'providers' => [
    //     'users' => [
    //         'driver' => 'eloquent',
    //         'model' => App\Models\User::class,  J'ai commente ca pour un test !!!!!!!!!!!!!!
    //     ],

    //     'users' => [
    //         'driver' => 'database', Remplacer par comptes
    //         'table' => 'users',
    //     ],
    // //],

    'providers' => [
    'comptes' => [
    //'users' => [ remplacer par compte
        'driver' => 'eloquent',
        'model' => App\Models\Compte::class,// j'ai remplacer le model User par Compte
         ],
    
    //Les autres provides a ajouter
        
    'residents' => [
        'driver' => 'eloquent',
        'model' => App\Models\Resident::class,
    ],
    'maires' => [
        'driver' => 'eloquent',
        'model' => App\Models\Mairie::class,
    ],
    'entreprises' => [
        'driver' => 'eloquent',
        'model' => App\Models\Entreprise::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
],


    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have more
    | than one user table or model in the application and you want to have
    | separate password reset settings based on the specific user types.
    |
    | The expiry time is the number of minutes that each reset token will be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    | The throttle setting is the number of seconds a user must wait before
    | generating more password reset tokens. This prevents the user from
    | quickly generating a very large amount of password reset tokens.
    |
    */

    'passwords' => [
        'comptes' => [
            'provider' => 'comptes', //j'ai remplace ici users par comptes
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | times out and the user is prompted to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

    'password_timeout' => 10800,

];
