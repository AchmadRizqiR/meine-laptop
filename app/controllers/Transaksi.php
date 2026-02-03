<?php

class Transaksi extends Controller
{

    private $api_url = BASE_API;

    public function index()
    {
        $data['transaksi'] = $this->callAPI('GET', $this->api_url . '/penyewaans.php');
        $this->view('transaksi/index', $data);
    }

    public function tambah()
    {
        $data['penyewas'] = $this->callAPI('GET', $this->api_url . '/penyewas.php');
        $laptops = $this->callAPI('GET', $this->api_url . '/laptops.php');

        // Filter laptop available
        $data['laptops'] = array_filter($laptops, fn($l) => $l['status'] == 'available');
        $this->view('transaksi/create', $data);
    }

    public function simpan()
    {
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
            'harga'       => (int)$_POST['total_harga_hidden'] 
        ];

        $this->callAPI('POST', $this->api_url . '/penyewaans.php', $postData);
        header('Location: ' . BASEURL . '/transaksi');
    }

    public function selesai($id)
    {
        $postData = [
            'id_sewa' => (int)$id
        ];

        $result = $this->callAPI('PUT', $this->api_url . '/penyewaans.php', $postData);

        header('Location: ' . BASEURL . '/transaksi');
        exit;
    }

    private function callAPI($method, $url, $data = null)
    {
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

    public function export()
    {
        $data = $this->callAPI('GET', $this->api_url . '/penyewaans.php'); // Ambil semua data transaksi

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Laporan_Rental_' . date('Y-m-d') . '.csv"');

        $output = fopen('php://output', 'w');
        // Header Kolom di Excel nanti
        fputcsv($output, ['Kode Sewa', 'Penyewa', 'Laptop', 'Tgl Mulai', 'Tgl Selesai', 'Harga', 'Denda', 'Status']);

        foreach ($data as $row) {
            fputcsv($output, [
                $row['kode_sewa'],
                $row['nama'],
                $row['brand'] . " " . $row['model'],
                $row['tgl_mulai'],
                $row['tgl_selesai'],
                $row['harga'],
                $row['denda'],
                $row['status']
            ]);
        }
        fclose($output);
        exit;
    }
}
