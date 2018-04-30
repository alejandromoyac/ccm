<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public function index()
    {
        // $this->load->view('welcome_message');
    }
    public function new_project()
    {
        $oper_id    = 1;
        $status_id  = 1;
        $prior_id   = $this->input->post('prior_id');
        $dept_id    = $this->input->post('dept_id');
        $city_id    = $this->input->post('city_id');
        $cli_id     = $this->input->post('cli_id');
        $comp_id    = $this->input->post('comp_id');
        $pj_details = $this->input->post('pj_details');
        $pj_d_reg   = date("Y-m-d H:i:s");
        $pj_d_start = '';
        $pj_d_end   = '';
        $pj_notes   = $this->input->post('pj_notes');

        echo "<pre>";
        print_r(get_defined_vars());
        echo "</pre>";

    }
    public function boot2()
    {
        $data['main_view'] = 'layout/demo';
        $data['js']        = 'layout/empty_js';
        $this->load->view('layout/header');
        $this->load->view('layout/content', $data);
        $this->load->view('layout/footer');
    }
}
