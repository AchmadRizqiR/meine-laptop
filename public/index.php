<?php
// Mulai session jika perlu
if( !session_id() ) session_start();

// Panggil file konfigurasi (URL, Database, dll)
require_once '../app/init.php';

// Inisialisasi Class App (Routing)
$app = new App;