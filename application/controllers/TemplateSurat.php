<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Templatesurat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('components/template');
    }
}

/* End of file TemplateSurat.php and path \application\controllers\TemplateSurat.php */
