<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('image_manip');
	}

	function index() {
		$this->load->view('upload/upload', array('error' => ' ' ));
	}

	function do_upload() {
		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100000';
		$config['max_width']  = '5000000';
		$config['max_height']  = '500000';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('upload/upload', $error);
		} else {
			$data = array('upload_data' => $this->upload->data());

			$result = $this->upload->data();
			$original_image = $result['full_path'];

			$data = array(
'image_library' => 'gd2',
'source_image' => $original_image,
'create_thumb' => TRUE,
'maintain_ratio' => TRUE,
'width'         => 75,
'height'       => 50,


				//'source_image' => $original_image,
				//'image_library' => 'gd2',
				//'library_path' => '/opt/ImageMagick/bin',
				//'x_axis' => '100',
				//'y_axis' => '60'	
			);

$this->image_manip->resize_image($data);

		} 
	}  
}