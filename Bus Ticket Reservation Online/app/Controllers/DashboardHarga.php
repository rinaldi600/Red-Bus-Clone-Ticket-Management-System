<?php

namespace App\Controllers;

class DashboardHarga extends BaseController
{

    private $validation;
    private $db;
    private $hargaModel;
    private $dateTime;
    private $timeStamp;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->validation = \Config\Services::validation();
        $this->validation->setRules([
            'harga' => [
                'label'  => 'Harga',
                'rules'  => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} wajib Diisi',
                    'min_length' => '{field} Minimal Berjumlah 4 Angka',
                ],
            ],
            'fasilitas' => [
                'label'  => 'Fasilitas',
                'rules'  => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib Diisi',
                    'min_length' => '{field} Minimal Berjumlah 8 Karakter',
                ],
            ],
            'kategori' => [
                'label'  => 'Kategori',
                'rules'  => 'regex_match[/[^Pilih Kategori]/]',
                'errors' => [
                    'regex_match' => '{field} Wajib Diisi',
                ],
            ],
        ]);

        $this->db = \Config\Database::connect();
        $this->hargaModel = new  \App\Models\HargaModel();
        $this->dateTime = new \DateTime(date('Y-m-d H:i:s'));
        $this->timeStamp = $this->dateTime->getTimestamp();
    }

    public function index()
    {
        $perPage = 2;

        if ($this->request->getGet('harga')) {
            $keyword = $this->request->getGet('harga');
            $this->hargaModel->like('category',$keyword)->orLike('harga',$keyword);
        }
        $number = $this->request->getGet('page_harga') ?
            ((int) $this->request->getGet('page_harga') * $perPage) - ($perPage - 1)
            : 1;

        $data = [
            'title' => 'Dashboard Admin',
            'dataHarga' => $this->hargaModel->paginate($perPage, 'harga'),
            'pager' => $this->hargaModel->pager,
            'number' => $number
        ];

        return view("DashboardAdmin/Harga/DashboardHarga", $data);
    }

    public function addHargaView() {
        $data = [
            'title' => 'Dashboard Admin',
        ];
        return view("DashboardAdmin/Harga/AddData", $data);
    }

    public function addHarga() {

        if ($this->validation->withRequest($this->request)->run()) {
            $harga = $this->request->getPost('harga', FILTER_SANITIZE_NUMBER_INT);
            $kategori = $this->request->getPost('kategori', FILTER_SANITIZE_STRING);
            $fasilitas = $this->request->getPost('fasilitas', FILTER_SANITIZE_STRING);
            $keterangan = $this->request->getPost('keterangan', FILTER_SANITIZE_STRING);
            if ($keterangan === "") {
                $keterangan = "Harga Bisa Berubah Sesuai Dengan Ketentuan Yang Berlaku";
            }

            $data = [
                'idHarga' => 'Harga-' .$this->timeStamp,
                'category' => $kategori,
                'harga' => $harga,
                'keterangan' => $keterangan,
                'fasilitas' => $fasilitas
            ];

            try {
                $this->hargaModel->insert($data);
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Menambahkan Data Harga');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata([
                'harga' => $this->validation->getError('harga'),
                'kategori' => $this->validation->getError('kategori'),
                'fasilitas' => $this->validation->getError('fasilitas'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function editHargaView() {
        $idHarga = $this->request->getGet('idHarga');
        $data = [
            'title' => 'Dashboard Admin',
            'dataHarga' => $this->hargaModel->where('idHarga', $idHarga)->first(),
        ];
        return view("DashboardAdmin/Harga/EditData", $data);
    }

    public function editHarga() {
        if ($this->validation->withRequest($this->request)->run()) {
            $idHarga = $this->request->getPost('idHarga');
            $harga = $this->request->getPost('harga', FILTER_SANITIZE_NUMBER_INT);
            $kategori = $this->request->getPost('kategori', FILTER_SANITIZE_STRING);
            $fasilitas = $this->request->getPost('fasilitas', FILTER_SANITIZE_STRING);

            if ($this->request->getPost('keterangan') == $this->request->getPost('oldKeterangan')) {
                $keterangan = $this->request->getPost('oldKeterangan');
            } else {
               $keterangan = $this->request->getPost('keterangan', FILTER_SANITIZE_STRING);
            }

            $data = [
                'category' => $kategori,
                'harga' => $harga,
                'keterangan' => $keterangan,
                'fasilitas' => $fasilitas,
            ];

            try {
                $this->hargaModel->where('idHarga', $idHarga)->set($data)->update();
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Mengubah Data Baru');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata([
                'harga' => $this->validation->getError('harga'),
                'kategori' => $this->validation->getError('kategori'),
                'fasilitas' => $this->validation->getError('fasilitas'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function deleteHarga() {
        if ($this->request->isAJAX()) {
            $idHarga = $this->request->getPost('idHarga');
            $this->hargaModel->where('idHarga', $idHarga)->delete();
            if ($this->db->affectedRows()) {
                return json_encode("Data Berhasil Dihapus");
            } else {
                return json_encode("Data Gagal Dihapus");
            }
        }
    }

}
