<?php
date_default_timezone_set('Asia/Jakarta');

class Controller {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    function model($model) {
        require_once("model/$model.class.php");
        return new $model;
    }

    function view($view, $data = []) {
        foreach($data as $key => $value) {
            $$key = $value;
        }
        
        include("view/$view.php");
    }
}