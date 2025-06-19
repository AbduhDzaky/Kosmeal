<?php

class Menu extends Controller {
    function index() {
        $model = $this->model('KosMealModel');
        $packages = $model->getAllPackages(); 
        $this->view('menu', ['packages' => $packages]);
    }
}