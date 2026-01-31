<?php

class Penyewa extends Controller {
    
    // Ganti URL ini dengan URL Tunnel temanmu (Endpoint: /api/penyewa)
    private $api_url = 'https://url-tunnel-temanmu.trycloudflare.com/api/penyewa'; 

    public function index() {
        $dataAPI = $this->callAPI('GET', $this->api_url);
        $data['penyewas'] = $dataAPI['data'] ?? [];
        $this->view('penyewa/index', $data);
    }

    public function tambah() {
        $this->view('penyewa/create');
    }

    public function simpan() {
        $postData = [
            'nama'   => $_POST['nama'],
            'telp'   => $_POST['telp'],
            'email'  => $_POST['email'],
            'alamat' => $_POST['alamat']
        ];
        
        $this->callAPI('POST', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/penyewa');
        exit;
    }

    public function edit($id) {
        $dataAPI = $this->callAPI('GET', $this->api_url . '/' . $id);
        $data['penyewa'] = $dataAPI['data'] ?? null;
        $this->view('penyewa/edit', $data);
    }

    public function update($id) {
        $postData = [
            'nama'   => $_POST['nama'],
            'telp'   => $_POST['telp'],
            'email'  => $_POST['email'],
            'alamat' => $_POST['alamat']
        ];

        $this->callAPI('PUT', $this->api_url . '/' . $id, $postData);
        header('Location: ' . BASEURL . '/penyewa');
        exit;
    }

    public function hapus($id) {
        $this->callAPI('DELETE', $this->api_url . '/' . $id);
        header('Location: ' . BASEURL . '/penyewa');
        exit;
    }

    // Fungsi Call API (Versi Aman PHP 8)
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
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                if ($data && is_array($data)) $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($curl);
        // curl_close($curl); // Auto close di PHP 8
        return json_decode($result, true);
    }
}