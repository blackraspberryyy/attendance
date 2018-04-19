<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            "title" => "Registration"
        );
        $this->load->view("registration/header", $data);
        $this->load->view("registration/main");
        $this->load->view("registration/footer");
    }

    public function confirm() {
        $this->form_validation->set_rules('student_id', 'Student Number', 'required|numeric|max_length[9]');
        if ($this->form_validation->run() == FALSE) {
            //ERROR
            $result = array(
                "success" => false,
                "text" => form_error("student_id")
            );
            echo json_encode($result);
        } else {
            //NO ERRORS
            $student_id = str_replace(' ', '', $this->input->post("student_id"));
            $student = $this->registration_model->fetch("student", array("student_id" => $student_id))[0];
            if(empty($student)){
                $result = array(
                    "success" => false,
                    "text"  => "Student ".$student_id." is not enrolled PROFETHICS W31"
                );
            }else{
                if($student->student_isPresent == 0){
                    $result = array(
                        "success" => true,
                        "text"  => "Valid Student number",
                        "student_name" => $student->student_lastname.", ".$student->student_firstname." ".$student->student_middlename,
                        "student_number" => $student_id,
                        "student_course" => $student->student_course,
                        "student" => $student
                    );
                }else{
                    $result = array(
                        "success" => false,
                        "text"  => "Student ".$student_id." has already been registered.",
                        "student" => $student
                    );
                }
                
            }
            echo json_encode($result);
        }
    }

    public function register() {
        $student_id = str_replace(' ', '', $this->input->post("student_id"));
        $student = $this->registration_model->fetch("student", array("student_id" => $student_id))[0];
        $data = array(
            "student_isPresent" => 1,
            "student_registeredAt" => time()
        );
        $this->registration_model->update($data, array("student_id" => $student_id));
        $result = array(
            "success" => true,
            "text"  => "[".date("m/d/Y G:i:s", $data["student_registeredAt"])."] : ".$student->student_lastname.", ".$student->student_firstname." ".$student->student_middlename." has been registered."
        );
        
        $this->session->set_flashdata("registration_success", $result["text"]);
        echo json_encode($result);
    }
    
    
    
    
}
