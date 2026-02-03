<?php

class Penyewa extends Controller {
    
    private $api_url = BASE_API . '/penyewas.php'; 

    public function index() {
        $data['penyewas'] = $this->callAPI('GET', $this->api_url);
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
    }

    public function edit($id) {
        $allPenyewa = $this->callAPI('GET', $this->api_url);
        
        $penyewa = null;
        foreach($allPenyewa as $p) {
            if($p['id_penyewa'] == $id) {
                $penyewa = $p;
                break;
            }
        }

        $data['penyewa'] = $penyewa;
        $this->view('penyewa/edit', $data);
    }

    public function update($id) {
        $postData = [
            'id_penyewa' => (int)$id,
            'nama'       => $_POST['nama'],
            'telp'       => $_POST['telp'],
            'email'      => $_POST['email'],
            'alamat'     => $_POST['alamat']
        ];
        $this->callAPI('PUT', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/penyewa');
        exit;
    }

    public function hapus($id) {
        $postData = ['id_penyewa' => (int)$id];
        $this->callAPI('DELETE', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/penyewa');
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