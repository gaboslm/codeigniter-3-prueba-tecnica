<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercrud extends CI_Controller {

	function __construct() 
    {
		parent::__construct();
        $this->load->model('user_model');
    }

    public function register_view()
	{
		$this->load->view('register');
	}

	public function users_view()
	{
		$users = $this->user_model->listUsers();
		$this->load->view('users', [ 'users' => $users ]);
	}

    public function register()
    {
        $first_name = $this->input->post('first_name');
        $las_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');
        $telephone = $this->input->post('telephone');
        $birth = $this->input->post('birth');

        $this->form_validation->set_rules('first_name','First Name','trim|required|alpha|max_length[50]');
        $this->form_validation->set_rules('last_name','Second Name','trim|required|alpha|max_length[50]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('gender','Gender','required|in_list[0,1,2]');
        $this->form_validation->set_rules('telephone','Telephone','required|integer|max_length[20]');
        $this->form_validation->set_rules('birth','Birth','required');
        
        if($this->form_validation->run())
        {
			try {
				$data = array(
					'FIRST_NAME'=> $first_name,
					'LAST_NAME'=> $las_name,
					'EMAIL'=> $email,
					'GENDER'=> $gender,
					'TELEPHONE'=> $telephone,
					'AGE'=> $birth,
				);
	
				$this->user_model->registerUser($data);
	
				$this->load->view('registered', ['message' => 'User successfully Registered!']);

			} catch (Exception $e) {
				log_message('error: ', $e->getMessage());
				return;
			}
        }
        else 
        {
            return $this->load->view('register', [
				'message' => 'fill all the required fields',
                'errors'=> explode("\n", strip_tags(validation_errors()))
			]);
        }
    }
	
}
