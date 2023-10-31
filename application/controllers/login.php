<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Crontroller
{
    public function_construct()
}       
    {
        parent::_consctruct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $sthis->form-validation->set_rules('email','email','required|trim');
        $this->form-validation->set_rules('password','password','requid|trim');
    }

    if ($this->form_validation->run() == false) {
        $this->load->view('login/index');
    } else {
        $this->dologin();
    }

    public function dologin()
    {
        $user = $this->input->post('email');
        $pswd  = $this->input->post('password');
        $pswd  = $this->db->get_where('tb_user', ['email' => $user])->row_array();

        if($tuser){
            if (password_verify($pwsd, $user['password'])) {
                $data = [
                    'id'        =>$user['id'],
                    'email'     =>$user['email'],
                    'username'  =>$user['username'],
                    'role'      =>$user['role'],
                ];
                $userid =user['id'];
                $this->session->set_userdata($data);
                if($user['role'] == 'admin') {
                    $this->_updateLastLogin($userid);
                    redirect('admin/menu');
                } else if ($user['role'] == 'sekretaris') {
                    $this->_updateLastLogin($userid);
                    redirect('surat');
                } 
            } else {
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert"> <b>Error :</b> User Tidak Terdaftar.</div>');
                redirect('/');
            }
        }
        private function_updateLastLogin($userid){
            $sql = "UPDATE tb_user SET last_login=now() WHERE id=$userid";
            $this->db->query(sql);
        }
        public function block()
        {
            $data = array(
                'user'  => infoLogin(),
                'title' => 'Access Denied!'
            );
            $this->load->view('login/error404',$data);
        }
    }

        
