<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PenggunaModel;

class PenggunaController extends BaseController
{
    protected UserModel $userModel;
    protected $helpers = ['form'];

    public function index()
    {
        $data = [
            'pretitle' => 'Pengguna',
            'title' => 'Akaun',
            'ctx' => 'pengguna',
            'data' => auth()->user()
         ];
   
         return view('pengguna/akaun', $data);
    }

    public function editAkaun()
    {
        // Get the User Provider (UserModel by default)
        $users = auth()->getProvider();

        // Get the user ID
        $idPengguna = auth()->user()->id;

        $rules = [
            'username' => [
                'rules' => [
                    'required',
                    'max_length[30]',
                    'min_length[3]',
                    'regex_match[/\A[a-zA-Z0-9\.]+\z/]',
                    'is_unique[users.username,id,' . $idPengguna . ']',
                ],
                'errors' => [
                    'required'    => 'Nama pengguna wajib diisi.',
                    'max_length'  => 'Nama pengguna terlalu panjang.',
                    'min_length'  => 'Nama pengguna terlalu pendek.',
                    'regex_match' => 'Nama pengguna hanya boleh mengandungi huruf, nombor, dan simbol ".".',
                    'is_unique'   => 'Nama pengguna sudah didaftar.'
                ],
            ],
            'full_name' => [
                'label' => 'Nama Penuh',
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
            'matric_no' => [
                'label' => 'Nombor Matrik',
                'rules' => [
                    'permit_empty',
                    'alpha_numeric',
                    'max_length[8]',
                ],
                'errors' => [
                    'alpha_numeric' => 'Nombor matrik tidak boleh mengandungi simbol.',
                    'max_length' => 'Nombor matrik tidak sah.'
                ]
            ],
            'phone' => [
                'label' => 'Nombor Telefon',
                'rules' => [
                    'required',
                    'min_length[8]',
                    'regex_match[/\A[0-9]+\z/]'
                ],
                'errors' => [
                    'required'    => 'Nombor telefon wajib diisi.',
                    'min_length'  => 'Nombor telefon terlalu pendek.',
                    'regex_match' => 'Nombor telefon tidak sah.'
                ],
            ],
        ];

        // Validate the input
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $matric_no = $this->request->getPost('matric_no');
        $matric_no = empty($matric_no) ? null : $matric_no; 

        $user = $users->findById($idPengguna);
        $user->fill([
            'username' => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'matric_no' => $matric_no,
            'phone' => $this->request->getPost('phone'),
        ]);
        
        // Save the user
        if (!$users->save($user)) {
            return redirect()->back()->with('errors', $users->errors());
        }

        return redirect()->to('/profile')->with('success', 'Edit akaun berhasil.');
    }
}