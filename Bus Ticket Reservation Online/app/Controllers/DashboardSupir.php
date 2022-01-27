<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;
use Faker\Provider\DateTime;

class DashboardSupir extends BaseController
{
    private $validation;
    private $db;
    private $supirModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $this->supirModel = new \App\Models\SupirModel();
        date_default_timezone_set('Asia/Jakarta');

        $this->validation->setRules([
                'namaSupir' => [
                    'label'  => 'Nama Supir',
                    'rules'  => 'required|alpha_space',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'alpha_space' => '{field} Hanya Boleh Mengandung Huruf Dan Spasi'
                    ],
                ],
                'handphoneSupir' => [
                    'label'  => 'Handphone Supir',
                    'rules'  => 'required|numeric|min_length[11]|max_length[12]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'numeric' => '{field} Hanya Boleh Mengandung Angka Saja',
                        'min_length' => '{field} Minimal 11 Angka',
                        'max_length' => '{field} Maksimal 12 Angka',
                    ],
                ],
                'alamatSupir' => [
                    'label'  => 'Alamat',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ],
                ],
            ]
        );

    }

    public function index()
    {

        $perPage = 2;
        if (($this->request->getGet('namaAtauAlamat') && $this->request->getGet('page_supir'))
        || ($this->request->getGet('page_supir') || $this->request->getGet('namaAtauAlamat')) ) {

            $number = $this->request->getGet('page_supir') ? ((int) $this->request->getGet('page_supir') * $perPage) - ($perPage - 1) : 1;
            $keyword = $this->request->getGet("namaAtauAlamat") ? $this->request->getGet("namaAtauAlamat") : '';
            $this->supirModel->like('nama', $keyword)->orLike('alamat', $keyword);

        } else {
            $number = 1;
        }

        $data = [
            'title' => 'Dashboard Admin',
            'listSupir' => $this->supirModel->paginate($perPage,'supir'),
            'pager' => $this->supirModel->pager,
            'number' => $number
        ];

        return view("DashboardAdmin/Supir/DashboardSupir", $data);
    }

    public function addSupirView() {
        $data = [
            'title' => 'Dashboard Admin'
        ];

        return view("DashboardAdmin/Supir/AddData", $data);
    }
    public function addSupir() {

        if ($this->validation->withRequest($this->request)->run()) {
            $namaSupir = $this->request->getPost('namaSupir');
            $handphoneSupir = $this->request->getPost('handphoneSupir');
            $alamatSupir = $this->request->getPost('alamatSupir');
            $time = Time::parse(date('Y/m/d H:i:s'));

            $data = [
                'idSupir' => 'Supir-'. $time->getTimestamp(),
                'nama' => $namaSupir,
                'handphone' => $handphoneSupir,
                'alamat' => $alamatSupir
            ];

            try {
                $this->supirModel->insert($data);
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Menambahkan Data Supir Baru');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }

        } else {
            session()->setFlashdata([
               'namaSupir' => $this->validation->getError('namaSupir'),
               'handphoneSupir' => $this->validation->getError('handphoneSupir'),
               'alamatSupir' => $this->validation->getError('alamatSupir'),
            ]);
            return redirect()->back()->withInput();
        }

    }

    public function editSupirView() {
        $data = [
            'title' => 'Dashboard Admin',
            'dataSupir' => $this->supirModel->where('idSupir', $this->request->getGet('idSupir'))->first(),
        ];
        return view("DashboardAdmin/Supir/EditData", $data);
    }

    public function editSupir() {
        if ($this->validation->withRequest($this->request)->run()) {

            $idSupir = $this->request->getPost('idSupir');
            $namaSupir = $this->request->getPost('namaSupir');
            $handphoneSupir = $this->request->getPost('handphoneSupir');
            $alamatSupir = $this->request->getPost('alamatSupir');

            $data = [
                'nama' => $namaSupir,
                'handphone' => $handphoneSupir,
                'alamat' => $alamatSupir
            ];

            try {
                $this->supirModel->set($data)->where('idSupir', $idSupir)->update();
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Mengubah Data Supir');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata([
                'namaSupir' => $this->validation->getError('namaSupir'),
                'handphoneSupir' => $this->validation->getError('handphoneSupir'),
                'alamatSupir' => $this->validation->getError('alamatSupir'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function deleteSupir() {

        // Check for AJAX request.
        if ($this->request->isAJAX()) {
            $idSupir = $this->request->getPost('idSupir');
            $this->supirModel->where('idSupir', $idSupir)->delete();
            if ($this->db->affectedRows()) {
                return json_encode("Data Berhasil Dihapus");
            } else {
                return json_encode("Data Gagal Dihapus");
            }
        }
    }
}
