<?php

namespace App\Controllers;

class DashboardTempat extends BaseController
{

    private $validation;
    private $db;
    private $tempatModel;
    private $dateTime;
    private $timeStamp;

    public function __construct() {
        date_default_timezone_set('Asia/Jakarta');
        $this->validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $this->tempatModel =  new \App\Models\TempatModel();
        $this->dateTime = new \DateTime(date('Y-m-d H:i:s'));
        $this->timeStamp = $this->dateTime->getTimestamp();

        $this->validation->setRules([
                'asal' => [
                    'label'  => 'Asal',
                    'rules'  => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'min_length' => '{field} Minimal 8 Karakter'
                    ],
                ],
                'tujuan' => [
                    'label'  => 'Tujuan',
                    'rules'  => 'required|min_length[8]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'min_length' => '{field} Minimal 8 Karakter'
                    ],
                ]
            ]
        );
    }

    public function index() {
        $perPage = 2;

        $number = $this->request->getGet('page_place') ?
            ((int) $this->request->getGet('page_place') * $perPage) - ($perPage - 1)
            : 1;

        if ($this->request->getGet('asalAtauTujuan')) {
            $keyword = $this->request->getGet('asalAtauTujuan');
            $this->tempatModel->like('asal',$keyword)->orLike('tujuan',$keyword);
        }

        $data = [
            'title' => 'Dashboard Admin',
            'listTempat' => $this->tempatModel->paginate($perPage,'place'),
            'pager' => $this->tempatModel->pager,
            'number' => $number
        ];
        return view("DashboardAdmin/Tempat/DashboardTempat", $data);
    }

    public function addTempatView() {
        $data = [
            'title' => 'Dashboard Admin',
        ];
        return view("DashboardAdmin/Tempat/AddData", $data);
    }

    public function addTempat() {
        if ($this->validation->withRequest($this->request)->run()) {
            $asal = $this->request->getPost('asal');
            $tujuan = $this->request->getPost('tujuan');
            if (strcmp($asal, $tujuan) == 0) {
                session()->setFlashdata('samePlace','Tempat asal dan tujuan tidak boleh sama');
                return redirect()->back()->withInput();
            }

            $data = [
              'idPlace' => 'Place-'. $this->timeStamp,
                'asal' => $asal,
                'tujuan' => $tujuan,
            ];

            try {
                $this->tempatModel->insert($data);
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Menambahkan Data Baru');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata([
               'asal' => $this->validation->getError('asal'),
               'tujuan' => $this->validation->getError('tujuan'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function editTempatView() {
        $idPlace = $this->request->getGet('idPlace');

        $data = [
            'title' => 'Dashboard Admin',
            'dataTempat' => $this->tempatModel->where('idPlace', $idPlace)->first(),
        ];
        return view("DashboardAdmin/Tempat/editData", $data);
    }

    public function editTempat() {
        if ($this->validation->withRequest($this->request)->run()) {
            $asal = $this->request->getPost('asal');
            $tujuan = $this->request->getPost('tujuan');
            $idPlace  = $this->request->getPost('idPlace');
            $data = [
                'asal' => $asal,
                'tujuan' => $tujuan,
            ];

            if (strcmp($asal, $tujuan) == 0) {
                session()->setFlashdata('samePlace','Tempat asal dan tujuan tidak boleh sama');
                return redirect()->back()->withInput();
            }

            try {
                $this->tempatModel->where('idPlace', $idPlace)->set($data)->update();
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Mengubah Data Baru');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
                d("Kesalahan Teknis");
            }

        } else {
            session()->setFlashdata([
                'asal' => $this->validation->getError('asal'),
                'tujuan' => $this->validation->getError('tujuan'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function deleteTempat() {
        if ($this->request->isAJAX()) {
            $idTempat = $this->request->getPost('idPlace');
            $this->tempatModel->where('idPlace', $idTempat)->delete();
            if ($this->db->affectedRows()) {
                return json_encode("Data Berhasil Dihapus");
            } else {
                return json_encode("Data Gagal Dihapus");
            }
        }
    }

}