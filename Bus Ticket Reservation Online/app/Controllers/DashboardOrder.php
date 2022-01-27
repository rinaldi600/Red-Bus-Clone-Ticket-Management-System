<?php

namespace App\Controllers;

class DashboardOrder extends BaseController
{

    private $orderModel;
    private $db;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->orderModel = new \App\Models\OrderModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $perPage = 5;
        $pageOrder = (int) $this->request->getGet('page_order');
        $number =  $pageOrder ? ($pageOrder * $perPage) - ($perPage - 1) : 1;

        if ($this->request->getGet('namaAtauTicket')) {
            $this->orderModel
                ->join('user','user.idUser = orderan.idUser')
            ->join('ticket','ticket.idTicket = orderan.idTicket')
                ->like('nama', $this->request->getGet('namaAtauTicket'))
            ->orLike('namaBus', $this->request->getGet('namaAtauTicket'));
        }

        $data = [
            'title' => 'Dashboard Admin',
            'dataOrder' => $this->orderModel->paginate($perPage,'order'),
            'pager' => $this->orderModel->pager,
            'number' => $number
        ];

        return view('DashboardAdmin/Order/DashboardOrder', $data);
    }

    public function deleteOrder() {
        if ($this->request->isAJAX()) {
            $this->orderModel->where('idOrder', $this->request->getPost('idOrder'))->delete();
            
            if ($this->db->affectedRows()) {
                return json_encode('Data Berhasil Dihapus');
            } else {
                return json_encode('Data Gagal Dihapus');
            }
        }
    }
}