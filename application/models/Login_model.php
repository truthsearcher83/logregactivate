<?php
class Login_model extends CI_Model{
public function login($email , $password) {
        $this->db->where([
            'email'=>$email,
         ]);
        $query = $this->db->get("user");
        if($query->num_rows() == 1){
            $db_password=$query->row(0)->password;
            if(password_verify($password,$db_password)){
                return $query->row(0)->user_id;
            }
        }else{
            return false;
        }
    }
}
                    


