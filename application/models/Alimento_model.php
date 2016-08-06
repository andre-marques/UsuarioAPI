<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/phpqrcode/qrlib.php');

/**
 * Created by PhpStorm.
 * User: André Marques Guedes
 * Date: 06/08/2016
 * Time: 09:43
 */
class Alimento_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

//////
    public function get($idalimento = null)
    {
        if (!is_null($idalimento)) {
            $query = $this->db->select('*')->from('alimento')->where('idalimento', $idalimento)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('alimento')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }

    public function getCode($qrcode = null)
    {
        if (!is_null($qrcode)) {
            $query = $this->db->select('*')->from('alimento')->where('qrcode', $qrcode)->get();
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }

        $query = $this->db->select('*')->from('alimento')->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return null;
    }


    public function save($alimento)
    {
        $this->db->set($this->_setAlimento($alimento))->insert('alimento');

        if ($this->db->affected_rows() === 1) {

            $idalimento = $this->db->insert_id();
            //URL QRCODE
            $qrcode = $idalimento.'_'.$alimento['nome'].'_'.$alimento['calorias'];
            //Montando os dados para o QR Code
            $cv  = "BEGIN:VCARD";
            $cv .= "/nid:".$idalimento;
            $cv .= "/nnome:".$alimento['nome'];
            $cv .= "/ncalorias:".$alimento['calorias'];
            $cv .= "END:VCARD";

            //Gerando a imagem com a classe QRcode
            $qrcode_url = APPPATH.'img_qrcode\\'.$qrcode.'.png';
            QRCode::png($cv, $qrcode_url, QR_ECLEVEL_H);

            $alimento['qrcode'] = $qrcode_url;

            $this->db->set($this->_setAlimento($alimento))->where('idalimento', $idalimento)->update('alimento');

            return $idalimento;
        }

        return null;
    }

    public function update($alimento)
    {
        $idalimento = $alimento['idalimento'];

        $this->db->set($this->_setAlimento($alimento))->where('idalimento', $idalimento)->update('alimento');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    public function delete($idalimento)
    {
        $this->db->where('idalimento', $idalimento)->delete('alimento');

        if ($this->db->affected_rows() === 1) {
            return true;
        }

        return null;
    }

    private function _setAlimento($alimento)
    {
        return array(
            'nome' => $alimento['nome'],
            'calorias' => $alimento['calorias'],
            'qrcode' => $alimento['qrcode'],
            'foto' => $alimento['foto']

        );
    }



//////


}