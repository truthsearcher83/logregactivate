<?php
class Register_model extends CI_Model{
public function store_captcha($data){
    $query = $this->db->insert_string('captcha', $data);
    return $this->db->query($query);
    }
public function add_user($data){ 
    // Insert user
    return $this->db->insert('user', $data);
    }
public function check_link($elink){
     $result = $this->db->get_where('user' ,array('elink' => $elink));
     return $result->num_rows();
}
public function activate_link($elink){
     $query = $this->db->get_where('user' ,array('elink' => $elink));
     $result=$query->row_array();
     $result['status']=1;
     $result['elink']= $result['elink'].'ok';
     $this->db->where('elink', $elink);
     $this->db->update('user', $result);
}
}

