<?php

return [
    'title' => env('APP_NAME', 'Template Project'),
    'subtitle' => 'recuitment',

    'logo_auth' => 'files/images/LOGO J-EXPERT.svg',
    'logo_auth_background' => 'white',

    'logo_panel' => 'files/images/LOGO J-EXPERT.svg',
    'logo_panel_background' => 'white',

    'registration_route' => 'register',
    'registration_default_role' => 'Member',

    'forgot_password_route' => 'password.request',
    'reset_password_route' => 'password.reset',

    // 'email_verification_route' => 'verification.index',
    'email_verification_route' => '',
    'email_verification_delay_time' => 30,

    'email_verify_route' => 'verification.verify',

    'profile_route' => 'profile',
    'profile_image' => 'assets/media/avatars/profile.png',

    'menu' => [
        // [
        //     'text' => 'Convert Data Ichijikin',
        //     'route'  => 'convert-data-ichijikin.index',
        //     'icon' => 'ki-duotone ki-element-11',
        // ],
        [
            'text' => 'J-Expert Kandidat',
            'route'  => 'exata.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        [
            'text' => 'Preview Kandidat',
            'route'  => 'exata_preview_candidate.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        [
            'text' => 'History Upload Preview',
            'route'  => 'exata_history_file_preview.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        [
            'text' => 'Form Kandidat',
            'route'  => 'exata_form_candidate.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        [
            'text' => 'Master Data Regency',
            'route'  => 'regency.index',
            'icon' => 'ki-duotone ki-element-11',
        ],
        // [
        //     'text' => 'Kendaraan',
        //     'icon' => 'ki-duotone ki-shield-tick',
        //     'submenu' => [
        //         [
        //             'text' => 'Data Kendaraan',
        //             'route' => 'vehicle.index',
        //             'icon_color' => 'success',
        //         ],
        //         [
        //             'text' => 'Penggunaan Kendaraan',
        //             'route' => 'vehicle-usage.index',
        //             'icon_color' => 'primary',
        //         ],
        //     ],
        // ],
        [
            'text' => 'Admin',
            'icon' => 'ki-duotone ki-shield-tick',
            'submenu' => [
                [
                    'text' => 'Pengguna',
                    'route' => 'user.index',
                    'icon_color' => 'success',
                ],
                [
                    'text' => 'Jabatan',
                    'route' => 'role.index',
                    'icon_color' => 'primary',
                ],
                [
                    'text' => 'Akses',
                    'route' => 'permission.index',
                    'icon_color' => 'primary',
                ],
            ],
        ],
    ],
];
