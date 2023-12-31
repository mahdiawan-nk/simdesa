<?php

class Migrate extends CI_Controller
{

        public function index()
        {
                $this->load->library('migration');
                
                if ($this->migration->find_migrations(['20231118035244_data_berita']) === FALSE)
                {
                        show_error($this->migration->error_string());
                }
        }

}