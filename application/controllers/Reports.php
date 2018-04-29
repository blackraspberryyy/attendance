<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            "title" => "Attendance",
            "students" => $this->registration_model->fetch("student")
        );
        $this->load->view("registration/header", $data);
        $this->load->view("reports/main");
        $this->load->view("registration/footer");
    }

    public function remove_attendance() {
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
            "text" => "[" . date("m/d/Y G:i:s") . "] : " . $student->student_lastname . ", " . $student->student_firstname . " " . $student->student_middlename . " has been removed from attendance list."
        );

        $this->session->set_flashdata("registration_neutral", $result["text"]);
        echo json_encode($result);
    }

    public function generate_pdf() {
        $students_first = $this->registration_model->fetchasc_first("student");
        $students_second = $this->registration_model->fetchasc_second("student");
//        echo "<pre>";
//        print_r($students);
//        echo "</pre>";
        $pdf = new TCPDF();
        $pdf->SetTitle('Attendance');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(10);
        $pdf->setFooterMargin(20);
        $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Author');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();
        $html = '<h1 style="text-align:center;">Attendance</h1><br>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $html = '<table border = "1" cellpadding = "2" cellspacing = "2">'
                . ' <thead>
                <tr>
                <td style = "font-size:13px; width:80px;"><b>Student ID.</b></td>
                <td style = "font-size:13px; width:200px;"><b>Name</b></td>
                <td style = "font-size:13px; width:110px;"><b>Course</b></td>
                <td style = "font-size:13px; width:140px;"><b>Registered At</b></td>
                </tr>

                </thead>';
        foreach ($students_first as $student) {
            if ($student->student_registeredAt == 0) {
                $html .= '<tr>
                <td width = "80">' . $student->student_id . '</td>
                <td style = "font-size:10px; width:200px;">' . $student->student_lastname . ', ' . $student->student_firstname . ' ' . $student->student_middlename . '</td>
                <td style = "font-size:10px; width:110px;"><b>' . $student->student_course . '</b></td>
                <td style = "font-size:10px; width:140px;"><b>Not Registered</b></td>
                </tr >';
            } else {
                $html .= '<tr>
                <td width = "80">' . $student->student_id . '</td>
                <td style = "font-size:10px; width:200px;">' . $student->student_lastname . ', ' . $student->student_firstname . ' ' . $student->student_middlename . '</td>
                <td style = "font-size:10px; width:110px;"><b>' . $student->student_course . '</b></td>
                <td style = "font-size:10px; width:140px;"><b>' . date("F d, Y - h:i:s A", $student->student_registeredAt) . '</b></td>
                </tr >';
            }
        }
        $html .= '</table>';

// Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->AddPage(); //ADD PAGE
        $html = '<table border = "1" cellpadding = "2" cellspacing = "2">'
                . ' <thead>
                <tr>
                <td style = "font-size:13px; width:80px;"><b>Student ID.</b></td>
                <td style = "font-size:13px; width:200px;"><b>Name</b></td>
                <td style = "font-size:13px; width:110px;"><b>Course</b></td>
                <td style = "font-size:13px; width:140px;"><b>Registered At</b></td>
                </tr>

                </thead>';
        foreach ($students_second as $student_second) {
            if ($student_second->student_registeredAt == 0) {
                $html .= '<tr>
                <td width = "80">' . $student_second->student_id . '</td>
                <td style = "font-size:10px; width:200px;">' . $student_second->student_lastname . ', ' . $student_second->student_firstname . ' ' . $student_second->student_middlename . '</td>
                <td style = "font-size:10px; width:110px;"><b>' . $student_second->student_course . '</b></td>
                <td style = "font-size:10px; width:140px;"><b>Not Registered</b></td>
                </tr >';
            } else {
                $html .= '<tr>
                <td width = "80">' . $student_second->student_id . '</td>
                <td style = "font-size:10px; width:200px;">' . $student_second->student_lastname . ', ' . $student_second->student_firstname . ' ' . $student->student_middlename . '</td>
                <td style = "font-size:10px; width:110px;"><b>' . $student_second->student_course . '</b></td>
                <td style = "font-size:10px; width:140px;"><b>' . date("F d, Y - h:i:s A", $student_second->student_registeredAt) . '</b></td>
                </tr >';
            }
        }
        $html .= '</table>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->lastPage();
        ob_end_clean();
        $pdf->Output('Attendance.pdf', 'I');
    }

}
