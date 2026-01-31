<?php

class Transaksi extends Controller {
    
    private $base = 'https://unopiatic-lucinda-unsuspended.ngrok-free.dev/BackendTubesLaragon';

    public function index() {
        $data['transaksi'] = $this->callAPI('GET', $this->base . '/penyewaans.php');
        $this->view('transaksi/index', $data);
    }

    public function tambah() {
        $data['penyewas'] = $this->callAPI('GET', $this->base . '/penyewas.php');
        $laptops = $this->callAPI('GET', $this->base . '/laptops.php');
        
        // Filter laptop available
        $data['laptops'] = array_filter($laptops, fn($l) => $l['status'] == 'available');
        $this->view('transaksi/create', $data);
    }

    public function simpan() {
        // Generate kode sewa sederhana
        $kode_sewa = "SEWA-" . date('Ymd') . "-" . rand(100, 999);
        
        // Cari harga laptop untuk hitung total di backend (opsional, bisa dari form)
        $postData = [
            'kode_sewa'   => $kode_sewa,
            'id_penyewa'  => (int)$_POST['id_penyewa'],
            'id_laptop'   => (int)$_POST['id_laptop'],
            'tgl_mulai'   => $_POST['tgl_mulai'],
            'tgl_selesai' => $_POST['tgl_selesai'],
            'status'      => 'ongoing',
            'harga'       => (int)$_POST['total_harga_hidden'] // Pastikan view kirim ini
        ];

        $this->callAPI('POST', $this->base . '/penyewaans.php', $postData);
        header('Location: ' . BASEURL . '/transaksi');
    }

    public function selesai($id) {
        $postData = [
            'id_sewa'          => (int)$id,
            'tgl_dikembalikan' => date('Y-m-d'),
            'status'           => 'selesai',
            'denda'            => 0 // Default 0, bisa dikembangkan sesuai logic telat
        ];

        $this->callAPI('PUT', $this->base . '/penyewaans.php', $postData);
        header('Location: ' . BASEURL . '/transaksi');
    }

    private function callAPI($method, $url, $data = null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        if ($method != "GET") {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        $result = curl_exec($curl);
        return json_decode($result, true);
    }
}