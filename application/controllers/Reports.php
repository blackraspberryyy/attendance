<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            "title"     => "Attendance",
            "students"  => $this->registration_model->fetch("student", array("student_isPresent" => 1))
        );
        $this->load->view("registration/header", $data);
        $this->load->view("reports/main");
        $this->load->view("registration/footer");
    }
}