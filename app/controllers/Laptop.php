<?php

class Laptop extends Controller {
    
    private $api_url = BASE_API . '/laptops.php'; 

    public function index() {
        $data['laptops'] = $this->callAPI('GET', $this->api_url);
        $this->view('laptop/index', $data);
    }

    public function tambah() {
        $this->view('laptop/create');
    }

    public function simpan() {
        $postData = [
            'kode_laptop' => $_POST['kode_laptop'],
            'brand'       => $_POST['brand'],
            'model'       => $_POST['model'],
            'spesifikasi' => $_POST['spesifikasi'],
            'harga_sewa'  => (int)$_POST['harga_sewa'],
            'status'      => $_POST['status']
        ];
        $this->callAPI('POST', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/laptop');
    }

    public function edit($id) {
        $laptop = $this->callAPI('GET', $this->api_url . '?id=' . $id);

        if (!$laptop || empty($laptop)) {
            echo "<script>
                    alert('Data laptop tidak ditemukan!');
                    window.location.href='" . BASEURL . "/laptop';
                </script>";
            exit;
        }

        $data['laptop'] = $laptop;
        $this->view('laptop/edit', $data);
    }

    public function update($id) {
        $postData = [
            'id_laptop'   => (int)$id, 
            'brand'       => $_POST['brand'],
            'model'       => $_POST['model'],
            'spesifikasi' => $_POST['spesifikasi'],
            'harga_sewa'  => (int)$_POST['harga_sewa'],
            'status'      => $_POST['status']
        ];
        $this->callAPI('PUT', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/laptop');
        exit;
    }

    public function hapus($id) {
        $postData = ['id_laptop' => (int)$id]; 
        $this->callAPI('DELETE', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/laptop');
    }

    private function callAPI($method, $url, $data = null) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

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
                if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
                break;
        }
        $result = curl_exec($curl);
        return json_decode($result, true);
    }
}