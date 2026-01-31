<?php
class Laptop extends Controller {
    
    // Ganti URL ini nanti dengan URL Tunnel temanmu
    private $api_url = 'https://url-tunnel-temanmu.trycloudflare.com/api/laptops'; 

    public function index() {
        $dataAPI = $this->callAPI('GET', $this->api_url);
        $data['laptops'] = $dataAPI['data'] ?? [];
        
        // Cukup panggil satu file ini
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
            'harga_sewa'  => $_POST['harga_sewa'],
            'status'      => $_POST['status']
        ];
        $this->callAPI('POST', $this->api_url, $postData);
        header('Location: ' . BASEURL . '/laptop');
        exit;
    }

    public function edit($id) {
        $dataAPI = $this->callAPI('GET', $this->api_url . '/' . $id);
        $data['laptop'] = $dataAPI['data'] ?? null;
        $this->view('laptop/edit', $data);
    }

    public function update($id) {
        $postData = [
            'kode_laptop' => $_POST['kode_laptop'],
            'brand'       => $_POST['brand'],
            'model'       => $_POST['model'],
            'spesifikasi' => $_POST['spesifikasi'],
            'harga_sewa'  => $_POST['harga_sewa'],
            'status'      => $_POST['status']
        ];
        $this->callAPI('PUT', $this->api_url . '/' . $id, $postData);
        header('Location: ' . BASEURL . '/laptop');
        exit;
    }

    public function hapus($id) {
        $this->callAPI('DELETE', $this->api_url . '/' . $id);
        header('Location: ' . BASEURL . '/laptop');
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
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default: // GET
                // Cek kalau data ada DAN berupa array, baru di-build
                if ($data && is_array($data)) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        // Setup cURL
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $result = curl_exec($curl);
        
        if(!$result){
            return null; // Handle jika koneksi gagal
        }

        return json_decode($result, true); 
    }
}