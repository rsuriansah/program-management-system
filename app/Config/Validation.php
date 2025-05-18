<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules for Registration
    // --------------------------------------------------------------------
    public $registration = [
        'username' => [
            'rules' => [
                'required',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                'max_length[16]',
                'min_length[6]',
                'is_unique[users.username]',
            ],
            'errors' => [
                'required'    => 'Nama pengguna wajib diisi.',
                'max_length'  => 'Nama pengguna terlalu panjang.',
                'min_length'  => 'Nama pengguna terlalu pendek.',
                'regex_match' => 'Nama pengguna tidak boleh mengandungi simbol kecuali "."',
                'is_unique'   => 'Nama pengguna sudah didaftar.'
            ],
        ],
        'email' => [
            'rules' => [
                'required',
                'max_length[254]',
                'valid_email',
                'is_unique[auth_identities.secret]',
            ],
            'errors' => [
                'required'    => 'Emel wajib diisi.',
                'max_length'  => 'Emel terlalu panjang.',
                'valid_email' => 'Emel tidak sah.',
                'is_unique'   => 'Emel sudah didaftar.'
            ],
        ],
        'password' => [
            'rules' => 'required|max_byte[72]|strong_password[]',
            'errors' => [
                'required' => 'Kata laluan wajib diisi.',
                'max_byte' => 'Kata laluan terlalu panjang.'
            ],
        ],
        'password_confirm' => [
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'Kata laluan (ulang) wajib diisi.',
                'matches'  => 'Kata laluan tidak sepadan.',
            ],
        ],
        'full_name' => [
            'rules' => [
                'required',
                'min_length[3]',
                'regex_match[/^[a-zA-Z\s]+$/]'
            ],
            'errors' => [
                'required'    => 'Nama wajib diisi.',
                'min_length'  => 'Nama terlalu pendek.',
                'regex_match' => 'Nama tidak boleh mengandungi nombor atau simbol.'
            ],
        ],
        'phone' => [
            'rules' => [
                'required',
                'regex_match[/\A[0-9]+\z/]',
                'min_length[8]',
            ],
            'errors' => [
                'required'    => 'Nombor telefon wajib diisi.',
                'min_length'  => 'Nombor telefon terlalu pendek.',
                'regex_match' => 'Nombor telefon tidak sah.'
            ],
        ],
    ];

    // --------------------------------------------------------------------
    // Rules for Login
    // --------------------------------------------------------------------
    public $login = [
        'username' => [
            'label' => 'Auth.username',
            'rules' => [
                'required',
                'max_length[30]',
                'min_length[3]',
                'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
            ],
        ],
        // 'email' => [
        //     'label' => 'Auth.email',
        //     'rules' => [
        //         'required',
        //         'max_length[254]',
        //         'valid_email'
        //     ],
        // ],
        'password' => [
            'label' => 'Auth.password',
                'rules' => [
                    'required',
                    'max_byte[72]',
                ],
            'errors' => [
                'max_byte' => 'Auth.errorPasswordTooLongBytes',
            ]
        ],
    ];
}