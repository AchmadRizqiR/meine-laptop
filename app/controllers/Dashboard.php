<?php

class Dashboard extends Controller
{
    public function index()
    {
        $laptops = $this->callAPI('GET', BASE_API . '/laptops.php');
        $transaksi = $this->callAPI('GET', BASE_API . '/penyewaans.php');
        $penyewa = $this->callAPI('GET', BASE_API . '/penyewas.php');

        $data['total_laptop'] = count($laptops);
        $data['tersedia'] = count(array_filter($laptops, fn($l) => $l['status'] == 'available'));
        $data['total_transaksi'] = count($transaksi);
        $data['transaksi_aktif'] = count(array_filter($transaksi, fn($t) => $t['status'] == 'ongoing'));
        $data['total_pendapatan'] = array_sum(array_column($transaksi, 'harga')) + array_sum(array_column($transaksi, 'denda'));

        $this->view('dashboard/index', $data);
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
