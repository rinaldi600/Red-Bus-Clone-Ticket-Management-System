<?php

namespace App\Controllers;

use Config\App;

class DashboardUser extends BaseController
{

    private $db;
    private $userModel;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->db = \Config\Database::connect();
        $this->userModel = new \App\Models\UserModel();
    }

    public function index()
    {
        $perPage = 5;
        $number = $this->request->getGet('page_user') ?
            ((int) $this->request->getGet('page_user') * $perPage ) - ($perPage - 1)
            : 1;

        if ($this->request->getGet('namaAtauAlamat')) {
            $this->userModel->like('nama',$this->request->getGet('namaAtauAlamat'))
                ->orLike('alamat', $this->request->getGet('namaAtauAlamat'));
        }

        $data = [
          'title' => 'Dashboard Admin',
            'dataUser' => $this->userModel->paginate($perPage,'user'),
            'pager' => $this->userModel->pager,
            'number' => $number,
        ];

        return view('DashboardAdmin/User/DashboardUser', $data);
    }

    public function deleteUser() {
        if ($this->request->isAJAX()) {
            $this->userModel->where('idUser', $this->request->getPost('idUser'))->delete();
            if ($this->db->affectedRows()) {
                return json_encode('Data Berhasil Dihapus');
            }
        }
    }
}
