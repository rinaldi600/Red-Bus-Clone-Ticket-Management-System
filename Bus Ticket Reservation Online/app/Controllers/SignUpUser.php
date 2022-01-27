<?php

namespace App\Controllers;

class SignUpUser extends BaseController
{
    public function index()
    {

        $data = [
            'title' => 'Sign Up User'
        ];

       return view("SignUpUser/SignUpView", $data);
    }

    public function signup() {
        $validation =  \Config\Services::validation();

        $validation->setRules([
                'nama' => [
                    'label'  => 'Nama',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                        'alpha_space' => 'Inputan {field} tidak boleh selain huruf dan spasi'
                    ],
                ],
                'username' => [
                    'label'  => 'Username',
                    'rules'  => 'required|alpha_numeric_punct|is_unique[user.username]',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                        'alpha_numeric_punct' => 'Inputan {field} tidak boleh selain huruf, spasi dan beberapa simbol',
                        'is_unique' => 'Inputan {field} sudah terdaftar'
                    ],
                ],
                'email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                        'valid_email' => 'Inputan {field} tidak valid',
                        'is_unique' => 'Inputan {field} sudah terdaftar'
                    ],
                ],
                'handphone' => [
                    'label'  => 'Handphone',
                    'rules'  => 'required|numeric|max_length[12]|min_length[11]',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                        'numeric' => 'Inputan {field} harus berupa angka',
                        'max_length' => 'Inputan {field} maksimal 12 angka',
                        'min_length' => 'Inputan {field} minimal 11 angka',
                    ],
                ],
                'alamat' => [
                    'label'  => 'Alamat',
                    'rules'  => 'required|regex_match[/^[\w, .]+/]|min_length[8]',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                         'regex_match' => 'Inputan {field} hanya boleh mengandung huruf, angka dan karakter seperti , .',
                        'min_length' => 'Inputan {field} minimal 8 huruf'
                    ],
                ],
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|alpha_numeric|max_length[20]|min_length[8]',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                        'alpha_numeric' => 'Inputan {field} harus mengandung huruf dan angka',
                        'max_length' => 'Inputan {field} maksimal 20 characters',
                        'min_length' => 'Inputan {field} minimal 8 characters',
                    ],
                ],
                'confirmPassword' => [
                    'label'  => 'Confirm Password',
                    'rules'  => 'required|alpha_numeric|matches[password]',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
                        'alpha_numeric' => 'Inputan {field} harus mengandung huruf dan angka',
                        'matches' => 'Inputan {field} harus sama'
                    ],
                ],
            ]
        );

        if ($validation->withRequest($this->request)->run()) {

            $db = \Config\Database::connect();
            $userModel = new \App\Models\UserModel();
            date_default_timezone_set('Asia/Jakarta');

            $data = [
                'idUser' => 'USER-'.uniqid(),
                'nama' => $this->request->getPost('nama'),
                'username' => $this->request->getPost('username'),
                'handphone' => $this->request->getPost('handphone'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'alamat' => $this->request->getPost('alamat'),
            ];

            try {
                $userModel->insert($data);
                if ($db->affectedRows()) {
                    session()->setFlashdata("success","Anda Berhasil Mendaftar Silahkan");
                    return redirect()->back();
                } else {
                    d("FAILS");
                }
            } catch (\ReflectionException $e) {
                d($e);
            }
        } else {
            session()->setFlashdata([
                'nama' => $validation->getError('nama'),
                'username' => $validation->getError('username'),
                'email' => $validation->getError('email'),
                'handphone' => $validation->getError('handphone'),
                'alamat' => $validation->getError('alamat'),
                'password' => $validation->getError('password'),
                'confirmPassword' => $validation->getError('confirmPassword'),
            ]);
            return redirect()->back()->withInput();
        }
    }

}
