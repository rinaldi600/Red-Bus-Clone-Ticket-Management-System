<?php

namespace App\Controllers;

use DateTime;
use Dompdf\Dompdf;

class DashboardTiket extends BaseController
{

    private $ticketModel;
    private $getTimeCurrent;
    private $orderModel;
    private $userModel;
    private $db;
    private $idUser;
    private $getUserLogIn;
    private $validation;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');

        if (session()->get('idUser')) {
            $this->idUser = session()->get('idUser');
        }

        $this->ticketModel =  new \App\Models\TicketModel();
        $this->orderModel = new \App\Models\OrderModel();
        $this->userModel = new \App\Models\UserModel();
        $this->db = \Config\Database::connect();
        $this->getTimeCurrent = time();
        $this->getUserLogIn = $this->userModel->where('idUSer', $this->idUser)->first();
        $this->validation = \Config\Services::validation();

        $this->validation->setRules([
            'jumlahPenumpang' => [
                'label'  => 'Jumlah Penumpang',
                'rules'  => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_natural_no_zero' => '{field} tidak boleh kurang dari sama dengan 0',
                ],
            ],
        ]);

    }

    public function index()
    {

        if ($this->request->getGet('tujuanAsal')) {
            $keyword = $this->request->getGet('tujuanAsal');

            $this->ticketModel->like('namaBus',$keyword)
                ->orLike('asal',$keyword)->orLike('tujuan',$keyword)
                ->orLike('tanggalBerangkat',$keyword);
        }

        $data = [
            'title' => 'RedBus Clone',
            'dataTicket' => $this->ticketModel
                ->join('supir','supir.idSupir = ticket.idSupir')
                ->join('place','place.idPlace = ticket.idPlace')
                ->join('harga','harga.idHarga = ticket.idHarga')->findAll(),
            'currentTime' => $this->getTimeCurrent,
            'dateTime' => date("Y-m-d H:i:s"),
            'userLogIn' => $this->getUserLogIn
        ];

        return view('HomePage/HomePage', $data);
    }

    public function detail($idTicket) {

        $data = [
            'title' => 'RedBus Clone',
            'detailTicket' => $this->ticketModel->where('idTicket', $idTicket)
                ->join('supir','supir.idSupir = ticket.idSupir')
                ->join('place','place.idPlace = ticket.idPlace')
                ->join('harga','harga.idHarga = ticket.idHarga')
                ->first(),
            'countSold' => $this->orderModel->selectSum('jumlah')
                ->where('status','Dibayar')
                ->where('idTicket', $idTicket)->first(),
            'userLogIn' => $this->getUserLogIn,
            'idUser' => $this->idUser,
        ];

        return view('HomePage/DetailTicket/DetailTicketView', $data);
    }

    public function orderTiket() {
        if ($this->validation->withRequest($this->request)->run()) {

            $data = [
              'idOrder' => 'Order-' . rand(),
                'noResi' => strtoupper(uniqid()),
                'idUser' => $this->request->getPost('idUser'),
                'idTicket' => $this->request->getPost('idTicket'),
                'jumlah' => $this->request->getPost('jumlahPenumpang'),
                'status' => 'Belum Dibayar',
                'total' => (int) ($this->request->getPost('jumlahPenumpang') * $this->request->getPost('harga')),
            ];

            try {
                $this->orderModel->insert($data);
                if ($this->db->affectedRows()) {
                    session()->setFlashdata('successOrder', 'Order Berhasil, Silahkan ke Keranjang Pembelian Untuk Menyelesaikan Pembayaran');
                    return redirect()->back();
                }
            } catch (\ReflectionException $e) {
            }
        } else {
            session()->setFlashdata('errorMessage',$this->validation->getError('jumlahPenumpang'));
            return redirect()->back()->withInput();
        }
    }

    public function user($username) {

        $data = [
            'title' => 'RedBus Clone',
            'userLogIn' => $this->getUserLogIn
        ];

        return view('HomePage/ProfileUser/ProfilePageView', $data);
    }

    public function purchase() {

        $data = [
            'title' => 'RedBus Clone',
            'userLogIn' => $this->getUserLogIn,
            'orderIncomplete' => $this->orderModel->where('idUser',$this->idUser)
                ->where('status', 'Belum Dibayar')
                ->join('ticket','ticket.idTicket = orderan.idTicket')
                ->findAll(),
            'orderComplete' => $this->orderModel->where('idUser',$this->idUser)
                ->where('status', 'Dibayar')
                ->findAll(),
            'number' => 1,
            'totalCountComplete' => $this->orderModel->selectSum('total')->where('idUser',$this->idUser)
                ->where('status', 'Dibayar')->findAll()
        ];

        return view('HomePage/Purchase/PurchaseView', $data);
    }

    public function payment() {
        if ($this->request->isAJAX()) {
            $getIdOrder = $this->request->getPost('idOrder');
            $number = 0;
            $data = array();
            $itemData = array();

            foreach ($getIdOrder as $idOrder) {
                $itemData['idOrder'] = $idOrder;
                $itemData['status'] = 'Dibayar';
                array_push($data, $itemData);
                $number++;
            }

            if ($number === count($getIdOrder)) {
                $this->orderModel->updateBatch($data,'idOrder');
                if ($this->db->affectedRows()) {
                    return json_encode('WORK');
                }
            }
        }
    }

    public function deleteOrder() {
        if ($this->request->isAJAX()) {
            $this->orderModel->where('idOrder', $this->request->getPost('idOrder'))->delete();

            if ($this->db->affectedRows()) {
                return json_encode('Data Berhasil Dihapus');
            }
        }
    }

    public function printOrder() {
        $idOrder = $this->request->getPost('idOrder');
        $detail = $this->orderModel->join('user','user.idUser = orderan.idUser')
            ->join('ticket','ticket.idTicket = orderan.idTicket')
            ->join('place','ticket.idPlace = place.idPlace')
            ->where('idOrder', $idOrder)->first();

        $html = "<html>
                  <head>
                    <style>
                      @page {
                            margin: 100px 50px;
                      }
                      @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap');
                      body {
                        font-family: 'Montserrat', sans-serif;
                      }
                      h1 {
                        text-align: center;
                        font-size: 19px;
                      }
                      #header {
                        position: fixed;
                        left: -50px; top: -100px; right: -50px; height: 100px;
                        background-color: orange;
                      }
                    </style>
                  </head>
                  <body>
                    <h1>Bukti Pembayaran</h1>
                    <div class='detail-pembayaran'>
                        <div class='section-one'>
                            <p>Company : Red Bus Clone</p>
                            <p>ID Order : ". $detail['idOrder'] ."</p>
                            <p>No Resi : ". $detail['noResi'] ."</p>
                            <p>ID User : ". $detail['idUser'] ."</p>
                            <p>Nama : ". $detail['nama'] ."</p>
                            <p>Username : ". $detail['username'] ."</p>
                            <p>Email : ". $detail['email'] ."</p>
                            <p>No. Handphone : ". $detail['handphone'] ."</p>
                            <p>Bus : ". $detail['namaBus'] ."</p>
                            <p>Total : Rp. ". number_format($detail['total'],0,',','.') ."</p>
                            <p>Tanggal Berangkat : ". date('Y-M-d H:i:s', strtotime($detail['tanggalBerangkat'])) ."</p>
                            <p>Jumlah : ". $detail['jumlah'] ." Orang</p>
                            <p>Tempat : ". $detail['asal']. ' -> '. $detail['tujuan'] ." Orang</p>
                        </div>
                    </div>
                  </body>
                </html>";

        $dompf = new Dompdf();

        $dompf->loadHtml($html);

        $dompf->setPaper('A4', 'portait');

        $dompf->render();

        $dompf->stream();
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/tiket');
    }
}
