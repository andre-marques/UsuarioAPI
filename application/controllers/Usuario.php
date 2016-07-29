<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/libraries/REST_Controller.php';


class Usuario extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
    }

    public function index_get()
    {
        $usuario = $this->usuario_model->get();

        if (!is_null($usuario)) {
            $this->response($usuario);
        } else {
            $this->response(array('msg' => 'Não há nada em sua base de dados...'), 404);
        }
    }

    public function find_get($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }
        $usuario = $this->usuario_model->get($id);

        if (!is_null($usuario)) {
            $this->response($usuario);
        } else {
            $this->response(array('msg' => 'Usuario não encontrado...'), 404);
        }
    }

    public function index_post()
    {

        $usuario = array('login' => $this->post('login'),'senha' => $this->post('senha'));

        $id = $this->usuario_model->save($usuario);

        if (!is_null($id)) {
            $this->response(array('msg' => 'Usuário salvo com sucesso id = '.$id), 200);
        } else {
            $this->response(array('msg', 'Há algo errado...'), 400);
        }

    }

    public function index_put()
    {
        $usuario = array('id'=>$this->put('id'), 'login' => $this->put('login'),'senha' => $this->put('senha'));

        $update = $this->usuario_model->update($usuario);

        if (!is_null($update)) {
            $this->response(array('msg' => 'Usuário atualizado!'), 200);
        } else {
            $this->response(array('msg' => 'Não foi possível atualizar o usuario...'), 400);
        }
    }

    public function index_delete($id)
    {
        if (!$id) {
            $this->response(null, 400);
        }

        $delete = $this->usuario_model->delete($id);

        if (!is_null($delete)) {
            $this->response(array('msg' => 'Usuário deletado com sucesso!'), 200);
        } else {
            $this->response(array('msg' => 'Não foi possível deletar o usuario...'), 400);
        }
    }
}