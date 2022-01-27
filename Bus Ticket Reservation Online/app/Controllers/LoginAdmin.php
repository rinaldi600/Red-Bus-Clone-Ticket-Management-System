<?php

namespace App\Controllers;

class LoginAdmin extends BaseController
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        if (session()->get('idAdmin')) {
            $db = \Config\Database::connect();
            $loginAdmin = new \App\Models\LoginAdmin();
            $loginAdmin->where('idAdmin', session()->get('idAdmin'))->where('sessionID', session_id())->delete();
            if ($db->affectedRows()) {
                session()->destroy();
            }
        }
        
        $data = [
            'title' => 'Login Admin'
        ];

       return view("LoginAdmin/LoginView", $data);
    }

    public function login() {
        $validation =  \Config\Services::validation();

        $validation->setRules([
                'usernameOrEmail' => [
                    'label'  => 'Username atau Email',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Inputan {field} tidak boleh kosong',
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
            ]
        );

        if ($validation->withRequest($this->request)->run()) {
            $adminModel = new \App\Models\AdminModel();
            $loginAdmin = new \App\Models\LoginAdmin();
            $db = \Config\Database::connect();
            $usernameOrEmail = $this->request->getPost('usernameOrEmail');
            $password = $this->request->getPost('password');

            $result = $adminModel->where('username', $usernameOrEmail)->orWhere('email', $usernameOrEmail)->first();

            if (!empty($result)) {
                $idAdmin = $result["idAdmin"];
                if (password_verify($password, $result["password"])) {
                    date_default_timezone_set('Asia/Jakarta');
                    session()->set("idAdmin", $idAdmin);
                    try {
                        $loginAdmin->insert([
                            'idAdmin' => $idAdmin,
                            'sessionID' => session_id(),
                        ]);
                        if ($db->affectedRows()) {
                            return redirect()->to("/DashboardAdmin");
                        }
                    } catch (\ReflectionException $e) {
                        d("Silahkan Login Beberapa Saat Kembali");
                    }
                } else {
                    session()->setFlashdata('invalidPassword','Password Salah');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('failed','Data Tidak Terdaftar');
                return redirect()->back()->withInput();
            }

        } else {
            session()->setFlashdata([
                'usernameOrEmail' => $validation->getError('usernameOrEmail'),
                'password' => $validation->getError('password')
            ]);
            return redirect()->back()->withInput();
        }
    }
}

