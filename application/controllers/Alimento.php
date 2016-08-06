<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';

/**
 * Created by PhpStorm.
 * User: André Marques Guedes
 * Date: 06/08/2016
 * Time: 09:43
 */
class Alimento extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('alimento_model');
    }

    public function index_get()
    {
        $alimento = $this->alimento_model->get();

        if (!is_null($alimento)) {
            $this->response($alimento);
        } else {
            $this->response(array('msg' => 'Nao ha nada em sua base de dados...'), 404);
        }
    }

    public function find_get($idalimento)
    {
        if (!$idalimento) {
            $this->response(null, 400);
        }
        $alimento = $this->alimento_model->get($idalimento);

        if (!is_null($alimento)) {
            $this->response($alimento);
        } else {
            $this->response(array('msg' => 'Alimento não encontrado...'), 404);
        }
    }

    public function index_post()
    {

        $alimento = array('nome' => $this->post('nome'),'calorias' => $this->post('calorias'),'qrcode' => $this->post('qrcode'));

        $idalimento = $this->alimento_model->save($alimento);

        if (!is_null($idalimento)) {
            $this->response(array('msg' => 'Alimento salvo com sucesso id = '.$idalimento), 200);
        } else {
            $this->response(array('msg', 'Há algo errado...'), 400);
        }

    }


    public function index_put()
    {
        $alimento = array('idalimento'=>$this->put('idalimento'), 'nome' => $this->put('nome'),'calorias' => $this->put('calorias'));

        $update = $this->alimento_model->update($alimento);

        if (!is_null($update)) {
            $this->response(array('msg' => 'Alimento atualizado!'), 200);
        } else {
            $this->response(array('msg' => 'Não foi possível atualizar o alimento...'), 400);
        }
    }

    public function index_delete($idalimento)
    {
        if (!$idalimento) {
            $this->response(null, 400);
        }

        $delete = $this->alimento_model->delete($idalimento);

        if (!is_null($delete)) {
            $this->response(array('msg' => 'Alimento deletado com sucesso!'), 200);
        } else {
            $this->response(array('msg' => 'Não foi possível deletar o alimento...'), 400);
        }
    }

    public function qrcode_get($qrcode){
        if (!$qrcode) {
            $this->response(null, 400);
        }
        $alimento = $this->alimento_model->getCode($qrcode);

        if (!is_null($alimento)) {
            $this->response($alimento);
        } else {
            $this->response(array('msg' => 'Alimento não encontrado...'), 404);
        }
    }

}