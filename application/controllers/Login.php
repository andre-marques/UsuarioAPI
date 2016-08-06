<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';


class Login extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index_get()
    {
        $login = $this->login_model->get();

        if (!is_null($login)) {
            $this->response($login);
        } else {
            $this->response(array('msg' => 'Nao ha nada em sua base de dados...'), 404);
        }
    }

    public function find_get($idlogin)
    {
        if (!$idlogin) {
            $this->response(null, 400);
        }
        $login = $this->login_model->get($idlogin);

        if (!is_null($login)) {
            $this->response($login);
        } else {
            $this->response(array('msg' => 'Login não encontrado...'), 404);
        }
    }

    public function index_post()
    {

        $login = array('login' => $this->post('login'),'senha' => $this->post('senha'));

        $idlogin = $this->login_model->save($login);

        if (!is_null($idlogin)) {
            $this->response(array('msg' => 'Login salvo com sucesso id = '.$id), 200);
        } else {
            $this->response(array('msg', 'Há algo errado...'), 400);
        }

    }

    public function index_put()
    {
        $login = array('id'=>$this->put('id'), 'login' => $this->put('login'),'senha' => $this->put('senha'));

        $update = $this->login_model->update($login);

        if (!is_null($update)) {
            $this->response(array('msg' => 'Login atualizado!'), 200);
        } else {
            $this->response(array('msg' => 'Não foi possível atualizar o login...'), 400);
        }
    }

    public function index_delete($idlogin)
    {
        if (!$idlogin) {
            $this->response(null, 400);
        }

        $delete = $this->login_model->delete($idlogin);

        if (!is_null($delete)) {
            $this->response(array('msg' => 'Login deletado com sucesso!'), 200);
        } else {
            $this->response(array('msg' => 'Não foi possível deletar o login...'), 400);
        }
    }
}