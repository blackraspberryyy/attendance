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
    
    public function remove_attendance(){
        $student_id = str_replace(' ', '', $this->input->post("student_id"));
        $student = $this->registration_model->fetch("student", array("student_id" => $student_id))[0];
        $data = array(
            "student_isPresent" => 0,
            "student_registeredAt" => 0
        );
        $this->registration_model->update($data, array("student_id" => $student_id));
        $result = array(
            "success" => true,
            "sample" => $student_id,
            "text"  => "[".date("m/d/Y G:i:s")."] : ".$student->student_lastname.", ".$student->student_firstname." ".$student->student_middlename." has been removed from attendance list."
            
        );
        
        $this->session->set_flashdata("registration_neutral", $result["text"]);
        echo json_encode($result);
    }
}