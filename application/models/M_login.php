<?php

class M_login extends CI_Model
{

    public function cek_login($username, $password)
    {
        $query = $this->db->query("SELECT * from akun where username='$username' and password='$password'");
        return $query;
    }

}
