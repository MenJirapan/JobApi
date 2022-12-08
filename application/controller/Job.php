<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Use Template AdminLTE.io. Version 3
class Job extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Job_model', 'Model', TRUE);
	}

	
	public function index()
	{	
		$data['header'] = 'News Data Api';
		
		$data['list'] = array(
								'<li class="breadcrumb-item"><a href="'.base_url("Path Url").'">Home</a></li>',
              					'<li class="breadcrumb-item active">'.$data["header"].'</li>'
						);

		$config["base_url"] = base_url("Path controller");
	    $config["total_rows"] = $this->Model->get_show();
	    $config["per_page"] = 20;
	    $config["uri_segment"] = 4;
	    $config['use_page_numbers'] = TRUE;

	    $config['full_tag_open'] = '<ul class="pagination pagination-sm justify-content-end">';
	    $config['full_tag_close'] = '</ul>';
	    $config['attributes'] = ['class' => 'page-link'];
	    $config['first_link'] = 'First';
	    $config['last_link'] = 'Last';
	    $config['first_tag_open'] = '<li class="page-item">';
	    $config['first_tag_close'] = '</li>';
	    $config['prev_link'] = '&laquo';
	    $config['prev_tag_open'] = '<li class="page-item">';
	    $config['prev_tag_close'] = '</li>';
	    $config['next_link'] = '&raquo';
	    $config['next_tag_open'] = '<li class="page-item">';
	    $config['next_tag_close'] = '</li>';
	    $config['last_tag_open'] = '<li class="page-item">';
	    $config['last_tag_close'] = '</li>';
	    $config['cur_tag_open'] = '<li class="page-item active"><a href=""  class="page-link">';
	    $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
	    $config['num_tag_open'] = '<li class="page-item">';
	    $config['num_tag_close'] = '</li>';

	    $page = $this->uri->segment(4) ? $this->uri->segment(4) : 1;

	    $this->pagination->initialize($config);

	    $data["links"] = $this->pagination->create_links();
	    $data['model'] = $this->Model->get_page_show($config["per_page"], $config["per_page"] * ( $page - 1 ));
	    $data['total'] = $this->Model->get_show();

        $this->load->view('job', $data);

	}

	public function search() 
	{
		$key = $this->input->post('key');

		$data['show'] = $this->Model->search($key);

		$data['header'] = 'News Data Api';
		$data['title'] = 'Result from search';
		
		$data['list'] = array(
								'<li class="breadcrumb-item"><a href="'.base_url("Path Url").'">Home</a></li>',
              					'<li class="breadcrumb-item"><a href="'.base_url("job").'">'.$data["header"].'</a></li>',
              					'<li class="breadcrumb-item active">'.$data["title"].'</li>'								
						);
		
        $this->load->view('show', $data);

	}


    public function ApiData()
    {

        $url = 'link of API';
        $json = file_get_contents($url);
        $job = json_decode($json);

		$this->Model->ApiData($job);
		redirect(base_url() . 'job', 'refresh');

    }

}