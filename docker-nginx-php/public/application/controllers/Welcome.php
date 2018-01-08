<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function index()
	{
		 $this->load->view('ya', array('error' => ' ' ));
	}



        public function upload_file()
        {
                $config['upload_path']          = './ok/';
                $config['allowed_types']        = 'gif|jpg|jpeg|png';

                $config['max_size']             = 500;

                $config['max_width']            = 1024;

                $config['max_height']           = 768;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userimage'))
                {    
                    
                    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('ya', $error);
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    
                    $file_name = $data['upload_data']['file_name'];

                    /* Image resize, crop, rotate, watermark code here */


                    $this->load->view('success', $data); 
                }
            }
        

  





}
