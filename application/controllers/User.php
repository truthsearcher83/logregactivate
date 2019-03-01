<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function check_captcha($captcha_input)
    {
        // First, delete old captchas
        $expiration = time() - 7200; // Two hour limit
        $this->db->where('captcha_time < ', $expiration)
                ->delete('captcha');

        // Then see if a captcha exists:
        $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
        $binds = array($captcha_input, $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();
        if ($row->count == 0){
            $this->form_validation->set_message('check_captcha', 'Captcha Fail');
            return FALSE;
        }else {
            return TRUE;
        }

    }
    public function check_email(){
        $query = $this->db->get_where('user', array('email' => $this->input->post('email')));
        $result = $query->num_rows();
        if ($result == 0){
            return TRUE;
        }else {
            $this->form_validation->set_message('check_email', 'Email Already Exists');
            return FALSE;
        }
    }
    public function activate($elink=NULL){ // user might send no parameter so set default to null to prevent error
        if(!empty($elink)){
           $link_check = $this->register_model->check_link($elink);
           if($link_check >=1){
              $this->register_model->activate_link($elink);
              $this->session->set_flashdata('active_success' , 'Activation Successfull');
              redirect('welcome');
           } else {
              $this->session->set_flashdata('active_fail' , 'Invalid Activation Code');
              redirect('welcome'); 
           }
        }
        else {
            $this->session->set_flashdata('active_fail' , 'Invalid Activation Code');
            redirect('welcome');
        }   
    }
    public function register(){   
        $this->load->helper('string');
        $random_string=random_string('alnum', 16);
        $this->form_validation->set_rules('user_name' , 'Name' , 'trim|required|max_length[32]'); 
        $this->form_validation->set_rules('captcha' , 'Captcha' , 'trim|required|max_length[32]|callback_check_captcha');
        $this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password','trim|required|min_length[5]|max_length[12]|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_email');
        if ($this->form_validation->run()==FALSE){
        //Captcha code 
        $this->load->helper('captcha');
        //Captcha Config 
        $vals = array(
            'img_path'      => './captcha/', //this nees to be path 
            'img_url'       => base_url('captcha'), // this needs to be url 
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 8,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
             'font_path'     => '/fonts/Open.ttf',

            // White background and border, black text and red grid
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        ); 
        //Create the Captcha
        $cap = create_captcha($vals);

        // Store The Created Captcha in DB for Verification  
        $data = array(
        'captcha_time'  => $cap['time'],
        'ip_address'    => $this->input->ip_address(),
        'word'          => $cap['word']
        );
        $this->register_model->store_captcha($data);
        //Load View
        $data['image']=$cap['image'];
        $this->load->view('templates/header');
        $this->load->view('register' , $data);
        $this->load->view('templates/footer');
        }else {
                  $option=array('cost'=>12);
                  $data['password']=password_hash($this->input->post('password'),PASSWORD_BCRYPT,$option);
                  $data['user_name'] = $this->input->post('user_name');
                  $data['email'] = $this->input->post('email');
                  $this->load->helper('string');
                  $data['elink']=random_string('alnum', 16);
                  $this->register_model->add_user($data);
                  $this->send_email($data);
                  redirect('user/success');
        }
    }
    private function send_email($data){
        $this->load->library('email'); // Note: no $config param needed
        $this->email->from('rajarshi.bose@gmail.com', 'Netwise');
        $this->email->to($data['email']);
        $this->email->subject('Activate Your Netwise Account');
        $message = 'Hi '.$data['user_name'].",<br/>Thanks for Registering with Netwise . Please click"
                    .'<a href="'.base_url().'user/activate/'.$data['elink'].'">Here</a> to activate account';
                    
        $this->email->message($message);
        if ($this->email->send()){
            echo 'Thanks for Registering .Please Check Your Email To Activate Account';
        } else {
            show_error($this->email->print_debugger());
        }
        exit();
    }
     public function login(){
        if($this->session->userdata('logged_in')){
                $this->load->view('user_home');
        } else {
            $this->form_validation->set_rules('captcha' , 'Captcha' , 'trim|required|max_length[32]|callback_check_captcha');
            $this->form_validation->set_rules('email' , 'Email' , 'trim|required|max_length[32]'); 
            $this->form_validation->set_rules('password', 'Password','trim|required|min_length[5]|max_length[12]');
            if ($this->form_validation->run()==FALSE){
                    //Captcha code 
                    $this->load->helper('captcha');
                    //Captcha Config 
                    $vals = array(
                        'img_path'      => './captcha/', //this nees to be path 
                        'img_url'       => base_url('captcha'), // this needs to be url 
                        'img_width'     => '150',
                        'img_height'    => 30,
                        'expiration'    => 7200,
                        'word_length'   => 8,
                        'font_size'     => 16,
                        'img_id'        => 'Imageid',
                         'font_path'     => '/fonts/Open.ttf',

                        // White background and border, black text and red grid
                        'colors'        => array(
                                'background' => array(255, 255, 255),
                                'border' => array(255, 255, 255),
                                'text' => array(0, 0, 0),
                                'grid' => array(255, 40, 40)
                        )
                    ); 
                    //Create the Captcha
                    $cap = create_captcha($vals);
                  
                    // Store The Created Captcha in DB for Verification  
                    $data = array(
                    'captcha_time'  => $cap['time'],
                    'ip_address'    => $this->input->ip_address(),
                    'word'          => $cap['word'] 
                    );
                    $this->register_model->store_captcha($data);
                    $data['title']='Login';
                    $data['image']= $cap['image'];
                    $this->load->view('templates/header');
                    $this->load->view('login',$data);
                    $this->load->view('templates/footer'); 
            } else {
                    $email=$this->input->post('email');
                    $password=$this->input->post('password');
                    $user_id=$this->login_model->login($email , $password);
                        if($user_id){
                                    $user_data=array(
                                    'user_id'=>$user_id,
                                    'email'=>$email,
                                    'logged_in'=>true);
                                    $this->session->set_userdata($user_data);
                                    $this->session->set_flashdata('login_success','Logged In Successfully');
                                    $this->load->view('templates/header');
                                    $this->load->view('user_home');
                                    $this->load->view('templates/footer');
                        }else{
                    $this->session->set_flashdata('login_failure','Log in Failure');
                    $this->load->view('templates/header');
                    redirect('welcome');
                    $this->load->view('templates/footer');
                }
            }
        }
     }
     public function logoff(){  
         $this->session->sess_destroy();
         redirect();
     }


    public function success(){
        $this->load->view('success');
    }
}
