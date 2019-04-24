<?php

class admin extends Controller
{
	protected $user;


	public function __construct()
	{
		// initliaze the models that need to be used in this controller
		$this->user = $this->model('user');
		$this->polling = $this->model('polling');
	}

	public function index()
	{
		// if user is not logged then it can not access this method
		if(Session::get('loggin') == false)
		{
			$this->redirect('admin/login');
		}

		
		$question = $this->polling->question();
		$answers = $this->polling->answers();
		
		
		$this->view('polling',array_merge($question,$answers));
	}

	public function login ()
	{
		// if already logged in the redirect to dashboard page
		if(Session::get('loggin') == true)
		{
			$this->redirect('admin/index');
		}

		if(isset($_POST) && !empty($_POST))
		{
		//call protected function to login the user
			$this->__postLogin();
		}

		$this->view('admin/login');
	}

	/* 
	*to logout from the system
	*/
	public function logout()
	{
		Session::destroy();
		$this->redirect('admin/login');
	}

	protected function __postLogin()
	{
		if(isset($_POST['submit']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$userData = $this->user->getBy('username', $username);
			if (isset($userData) && !empty($userData)) 
			{
				if (MD5($password) == $userData['0']['password']) 
				{
					//set the session to true
					Session::set('loggin',true);
					// if matches username and password redirect to index
					$this->redirect('admin/index');
				} 
				else
				{
					//when password is wrong
					$response = array();
					$response['message'][] = 'Your password is wrong, please try again !';
					$this->view('admin/login', $response);
				}
			} 
			else
			{
				// when username is wrong
				$response = array();
				$response['message'][] = 'Your Username is wrong, please try again !';
				$this->view('admin/login', $response);	
			}
		}
		else
		{
			// if user press submit button without entering username and password
			$response = array();
			$response['message'][] = 'Please enter username and password to login !';
			$this->view('admin/login',$response);
		}
	}
	
	public function insert_poll(){
			$data = $_POST['answer'];
				
			$last_insert_id = $this->polling->save_poll($data);
		
	}

	public function results()
	{
		$results = $this->polling->results();
		
		for($i=0;$i<count($results);$i++){
			$data [] = array("name"=>$results[$i]['answer'],
					"y"=>$results[$i]['ans_count']);
		}
		//echo "<pre>";
		echo json_encode($data, JSON_NUMERIC_CHECK);
		exit;
	}
		
}