<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id = null)
    {
        if (!is_null($id)) {
            $query = $this->db->select('*')->from('usuario')->where('id', $id)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('usuario')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function save($usuario)
    {
        $this->db->set($this->_setUsuario($usuario))->insert('usuario');

        if ($this->db->affected_rows() === 1) {
            return $this->db->insert_id();
        }

        return null;
    }

    public function update($usuario)
    {
        $id = $usuario['id'];

        $this->db->set($this->_setUsuario($usuario))->where('id', $id)->update('usuario');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($id)
    {
        $this->db->where('id', $id)->delete('usuario');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setUsuario($usuario)
    {
        return array(
            'login' => $usuario['login'],
            'senha' => $usuario['senha']
        );
    }
}