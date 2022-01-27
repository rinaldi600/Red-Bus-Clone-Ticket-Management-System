<?php
namespace App\Controllers;

class DashboardAdmin extends BaseController
{

    private $validation;
    private $db;
    private $dateTime;
    private $timeStamp;
    private $supirModel;
    private $tempatModel;
    private $hargaModel;
    private $ticketModel;
    private $userModel;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->validation = \Config\Services::validation();

        $this->validation->setRules([
            'bus' => [
                'label'  => 'Bus',
                'rules'  => 'required|alpha_numeric_space|min_length[4]',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'alpha_numeric_space' => '{field} Tidak boleh mengandung selain huruf dan angka',
                    'min_length' => '{field} minimal 4 karakter'
                ],
            ],
            'tanggalBerangkat' => [
                'label'  => 'Tanggal Berangkat',
                'rules'  => 'required|valid_date',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'valid_date' => '{field} Tidak boleh mengandung selain format tanggal'
                ],
            ],
            'jumlahPenumpang' => [
                'label'  => 'Jumlah Penumpang',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => '{field} Wajib Diisi',
                    'numeric' => '{field} Harus Berupa Angka'
                ],
            ],
            'supir' => [
                'label'  => 'Supir',
                'rules'  => 'regex_match[/[^Pilih Supir]/]',
                'errors' => [
                    'regex_match' => '{field} Wajib Diisi',
                ],
            ],
            'tempat' => [
                'label'  => 'Tempat',
                'rules'  => 'regex_match[/[^Pilih Tempat]/]',
                'errors' => [
                    'regex_match' => '{field} Wajib Diisi',
                ],
            ],
            'harga' => [
                'label'  => 'Harga',
                'rules'  => 'regex_match[/[^Pilih Harga]/]',
                'errors' => [
                    'regex_match' => '{field} Wajib Diisi',
                ],
            ],
        ]);

        $this->db = \Config\Database::connect();
        $this->supirModel = new \App\Models\SupirModel();
        $this->tempatModel = new \App\Models\TempatModel();
        $this->hargaModel = new \App\Models\HargaModel();
        $this->ticketModel = new \App\Models\TicketModel();
        $this->userModel = new \App\Models\UserModel();
        $this->dateTime = new \DateTime(date('Y-m-d H:i:s'));
        $this->timeStamp = $this->dateTime->getTimestamp();
    }

    public function index()
    {
        $perPage = 4;
        $number = $this->request->getGet('page_ticket') ?
            ((int) $this->request->getGet('page_ticket') * $perPage ) - ($perPage - 1) : 1;

        if ($this->request->getGet('keywordTicket')) {
            $this->ticketModel->like('namaBus',$this->request->getGet('keywordTicket'));
        }

        $data = [
            'title' => 'Dashboard Admin',
            'dataTicket' => $this->ticketModel->paginate($perPage,'ticket'),
            'pager' => $this->ticketModel->pager,
            'number' => $number
        ];

        return view("DashboardAdmin/DashboardView", $data);
    }

    public function addTicketView() {

        $data = [
            'title' => 'Dashboard Admin',
            'dataSupir' => $this->supirModel->findAll(),
            'dataTempat' => $this->tempatModel->findAll(),
            'dataHarga' => $this->hargaModel->findAll(),
        ];

        return view("DashboardAdmin/AddDataTicket", $data);
    }

    public function addTicket() {
        if ($this->validation->withRequest($this->request)->run()) {
            $tanggalBerangkat = $this->request->getPost('tanggalBerangkat');
                $dateTime = new \DateTime($tanggalBerangkat);
                $tanggalBerangkat = $dateTime->format('Y-n-j H:i:s');
                $jumlahPenumpang = (int) $this->request->getPost('jumlahPenumpang', FILTER_SANITIZE_NUMBER_INT);
                $idTicket = 'Ticket-'. $this->timeStamp;
                $namaBus = $this->request->getPost('bus', FILTER_SANITIZE_STRING);
                $idSupir = $this->request->getPost('supir');
                $idPlace =  $this->request->getPost('tempat');
                $idHarga = $this->request->getPost('harga');

                $data = [
                    'idTicket' => $idTicket,
                    'namaBus' => $namaBus,
                    'idSupir' => $idSupir,
                    'idPlace' => $idPlace,
                    'idHarga' => $idHarga,
                    'tanggalBerangkat' => $tanggalBerangkat,
                    'jumlahPenumpang' => $jumlahPenumpang
                ];

            try {
                $this->ticketModel->insert($data);
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Berhasil Menambahkan Data Ticket');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata([
                'bus' => $this->validation->getError('bus'),
                'supir' => $this->validation->getError('supir'),
                'tempat' => $this->validation->getError('tempat'),
                'harga' => $this->validation->getError('harga'),
                'tanggalBerangkat' => $this->validation->getError('tanggalBerangkat'),
                'jumlahPenumpang' => $this->validation->getError('jumlahPenumpang'),
            ]);
            return redirect()->back()->withInput();
        }

    }

    public function editTicketView() {

        $data = [
            'title' => 'Dashboard Admin',
            'dataSupir' => $this->supirModel->findAll(),
            'dataTempat' => $this->tempatModel->findAll(),
            'dataHarga' => $this->hargaModel->findAll(),
            'dataTicket' => $this->ticketModel->where('idTicket', $this->request->getGet('idTicket'))->first(),
        ];
        return view('DashboardAdmin/EditDataTicket', $data);
    }

    public function editTicket() {
        if ($this->validation->withRequest($this->request)->run()) {

            $idTicket = $this->request->getPost('idTicket');
            $namaBus = $this->request->getPost('bus', FILTER_SANITIZE_STRING);
            $idSupir = $this->request->getPost('supir');
            $idPlace =  $this->request->getPost('tempat');
            $idHarga = $this->request->getPost('harga');
            $tanggalBerangkat = date('Y-n-j H:i:s', strtotime($this->request->getPost('tanggalBerangkat')));
            $jumlahPenumpang = (int) $this->request->getPost('jumlahPenumpang', FILTER_SANITIZE_NUMBER_INT);

            $data = [
                'namaBus' => $namaBus,
                'idSupir' => $idSupir,
                'idPlace' => $idPlace,
                'idHarga' => $idHarga,
                'tanggalBerangkat' => $tanggalBerangkat,
                'jumlahPenumpang' => $jumlahPenumpang,
            ];

            try {
                $this->ticketModel->where('idTicket', $idTicket)->set($data)->update();

                if ($this->db->affectedRows()) {
                    session()->setFlashdata('suksesAddData','Data Berhasil Diubah');
                    return redirect()->back();
                } else {
                    d("DATA GAGAL DIUBAH");
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata([
                'bus' => $this->validation->getError('bus'),
                'supir' => $this->validation->getError('supir'),
                'tempat' => $this->validation->getError('tempat'),
                'harga' => $this->validation->getError('harga'),
                'tanggalBerangkat' => $this->validation->getError('tanggalBerangkat'),
                'jumlahPenumpang' => $this->validation->getError('jumlahPenumpang'),
            ]);
            return redirect()->back()->withInput();
        }
    }

    public function deleteTicket() {
        if ($this->request->isAJAX()) {
            $this->ticketModel->where('idTicket', $this->request->getPost('idTicket'))->delete();

            if ($this->db->affectedRows()) {
                return json_encode('Data Berhasil Dihapus');
            } else {
                return json_encode('Data Gagal Dihapus');
            }
        }
    }

    public function logout() {
        if (session()->get('idAdmin')) {
            date_default_timezone_set('Asia/Jakarta');
            $db = \Config\Database::connect();
            $loginAdmin = new \App\Models\LoginAdmin();
            $loginAdmin->where('idAdmin', session()->get('idAdmin'))->where('sessionID', session_id())->delete();
            if ($db->affectedRows()) {
                session()->destroy();
                return redirect()->to("/LoginAdmin");
            }
        }
    }

    public function getDetailInfo() {
        if ($this->request->isAJAX()) {
            if ($this->request->getPost('idSupir')) {
                return json_encode($this->supirModel->where('idSupir', $this->request->getPost('idSupir'))->first());
            } else if ($this->request->getPost('idPlace')) {
                return json_encode($this->tempatModel->where('idPlace', $this->request->getPost('idPlace'))->first());
            } else if ($this->request->getPost('idUser')) {
                return json_encode($this->userModel->where('idUser', $this->request->getPost('idUser'))->first());
            } else if ($this->request->getPost('idTicket')) {
                return json_encode($this->ticketModel
                    ->join('supir','supir.idSupir = ticket.idSupir')
                ->join('place','place.idPlace = ticket.idPlace')
                ->join('harga','harga.idHarga = ticket.idHarga')
                ->where('idTicket', $this->request->getPost('idTicket'))->first());
            } else {
                return json_encode($this->hargaModel->where('idHarga', $this->request->getPost('idHarga'))->first());
            }
        }
    }
}
