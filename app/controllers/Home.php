<?php

class Home extends Controller {
    public function index() {
        // Memanggil method view dari Base Controller
        $this->view('home/index');
    }
}