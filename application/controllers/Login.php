<?php
class Login extends CI_Controller 
{
  
      function __construct(){
        parent::__construct();
        $this->load->model('login_model');
      }
     
      function index(){
        $this->load->view('login_view');
      }
     
      function auth(){
       // echo 'll';
       // exit;
        $email    = $this->input->post('email',TRUE);
        $password = $this->input->post('password',TRUE);
        $validate = $this->login_model->validate($email,$password);
        if($validate->num_rows() > 0){
            $data  = $validate->row_array();
            $name  = $data['username'];
            $email = $data['email'];
            $role = $data['role'];
            $sessiondata = array(
                'username'  => $name,
                'email'     => $email,
                'role'     => $role,
                'logged_in' => TRUE
            );
         $this->session->set_userdata($sessiondata);
        // echo $sessiondata['role'];
         //exit;
            if($role === '1'){
                redirect('page');
     
            }elseif($role === '2'){
                redirect('page/staff');
     
            }else{
                redirect('page/author');
            }
        }else{
            echo $this->session->set_flashdata('msg','name or Password is Wrong');
            redirect('login');
        }
      }
     
      function logout(){
          $this->session->sess_destroy();
          redirect('login');
      }
      
      function images(){
        echo "not uploaded";

      }
    



}
