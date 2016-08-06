<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($idlogin = null)
    {
        if (!is_null($idlogin)) {
            $query = $this->db->select('*')->from('login')->where('idlogin', $idlogin)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('login')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function save($login)
    {
        $this->db->set($this->_setLogin($login))->insert('login');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($login)
    {
        $id = $login['idlogin'];

        $this->db->set($this->_setLogin($login))->where('idlogin', $idlogin)->update('login');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($idlogin)
    {
        $this->db->where('idlogin', $idlogin)->delete('login');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setLogin($login)
    {
        return array(
            'login' => $login['login'],
            'senha' => $login['senha']
        );
    }
}