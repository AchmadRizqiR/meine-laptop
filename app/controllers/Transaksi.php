<?php

class Transaksi extends Controller {
    
    // GANTI URL TUNNEL DI SINI
    private $api_base = 'https://url-tunnel-temanmu.trycloudflare.com/api'; 

    public function index() {
        // Ambil data transaksi
        $dataAPI = $this->callAPI('GET', $this->api_base . '/penyewaan');
        $data['transaksi'] = $dataAPI['data'] ?? [];
        $this->view('transaksi/index', $data);
    }

    public function tambah() {
        // 1. Ambil data Penyewa buat dropdown
        $penyewaAPI = $this->callAPI('GET', $this->api_base . '/penyewa');
        
        // 2. Ambil data Laptop buat dropdown
        $laptopAPI = $this->callAPI('GET', $this->api_base . '/laptops');

        // Filter cuma laptop yang statusnya 'available'
        $allLaptops = $laptopAPI['data'] ?? [];
        $availableLaptops = array_filter($allLaptops, function($l) {
            return $l['status'] == 'available';
        });

        $data['penyewas'] = $penyewaAPI['data'] ?? [];
        $data['laptops']  = $availableLaptops;

        $this->view('transaksi/create', $data);
    }

    public function simpan() {
        $postData = [
            'id_penyewa'  => $_POST['id_penyewa'],
            'id_laptop'   => $_POST['id_laptop'],
            'tgl_mulai'   => $_POST['tgl_mulai'],
            'tgl_selesai' => $_POST['tgl_selesai'],
            // Status default biasanya dihandle API, tapi kalau perlu kirim:
            'status'      => 'ongoing' 
        ];
        
        $this->callAPI('POST', $this->api_base . '/penyewaan', $postData);
        header('Location: ' . BASEURL . '/transaksi');
        exit;
    }

    // Fitur Kembalikan Laptop (Selesaikan Transaksi)
    public function selesai($id) {
        // Biasanya API butuh tgl_kembali atau update status
        $updateData = [
            'status' => 'selesai',
            'tgl_dikembalikan' => date('Y-m-d')
        ];

        // Pakai PUT ke endpoint detail transaksi
        $this->callAPI('PUT', $this->api_base . '/penyewaan/' . $id, $updateData);
        header('Location: ' . BASEURL . '/transaksi');
        exit;
    }

    private function callAPI($method, $url, $data = null) {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
            default:
                if ($data && is_array($data)) $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($curl);
        return json_decode($result, true);
    }
}