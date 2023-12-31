<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateSurat extends CI_Controller {

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
