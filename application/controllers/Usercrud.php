<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usercrud extends RestApi_Controller {

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

    public function edit_view()
    {
        $id = $this->input->get('id');
        $exists = $this->user_model->checkExists($id);
        
        if($exists)
        {
            try {

                $user = $this->user_model->getUser($id);
                $this->load->view('edit', ['user' => $user]);

            } catch (Exception $e) {
				log_message('error: ', $e->getMessage());
				return;
			}
        }
        else
        {
            $this->load->view('edit', [
                'deleted' => false,
                'message' => 'User does not exists!',
            ]);
        }
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
        
        $data = new stdClass();
        $data->FIRST_NAME = $first_name;
        $data->LAST_NAME = $las_name;
        $data->EMAIL = $email;
        $data->GENDER = $gender;
        $data->TELEPHONE = $telephone;
        $data->AGE = $birth;

        if($this->form_validation->run())
        {
			try {
                
				$this->user_model->registerUser($data);
	
				$this->load->view('done', ['created' => true, 'message' => 'User created successfully!']);

			} catch (Exception $e) {
				log_message('error: ', $e->getMessage());
				return;
			}
        }
        else 
        {
            return $this->load->view('register', [
				'message' => 'fill all the required fields',
                'errors'=> explode("\n", strip_tags(validation_errors())),
                'user' => $data,
			]);
        }
    }

    public function update()
    {
        $id = $this->input->post('id');
        $first_name = $this->input->post('first_name');
        $las_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');
        $telephone = $this->input->post('telephone');
        $birth = $this->input->post('birth');

        $this->form_validation->set_rules('first_name','First Name','trim|required|alpha|max_length[50]');
        $this->form_validation->set_rules('last_name','Second Name','trim|required|alpha|max_length[50]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('gender','Gender','required|in_list[0,1,2]');
        $this->form_validation->set_rules('telephone','Telephone','required|integer|max_length[20]');
        $this->form_validation->set_rules('birth','Birth','required');
        
        $data = new stdClass();
        $data->ID = $id;
        $data->FIRST_NAME = $first_name;
        $data->LAST_NAME = $las_name;
        $data->EMAIL = $email;
        $data->GENDER = $gender;
        $data->TELEPHONE = $telephone;
        $data->AGE = $birth;

        if($this->form_validation->run())
        {
			try {
	
				$this->user_model->updateUser($data);
	
				$this->load->view('done', [
                    'updated' => true, 
                    'message' => 'User updated successfully!'
                ]);

			} catch (Exception $e) {
				log_message('error: ', $e->getMessage());
				return;
			}
        }
        else 
        {
            return $this->load->view('edit', [
				'message' => 'fill all the required fields',
                'errors'=> explode("\n", strip_tags(validation_errors())),
                'user' => $data,
			]);
        }
    }

    public function delete()
    {
        $id = $this->input->get('id');
        $exists = $this->user_model->checkExists($id);
        
        if($exists)
        {
            try {
                $this->user_model->deleteUser($id);

                $users = $this->user_model->listUsers();

                $this->response([
                    'deleted' => true,
                    'message' => 'User deleted successfully!',
                    'users' => $users
                ], 200);

            } catch (Exception $e) {
				log_message('error: ', $e->getMessage());
				return;
			}
        }
        else
        {
            $this->response([
                'deleted' => false,
                'message' => 'User does not exists!',
                'users' => $users
            ], 200);
        }
    }
	
}
