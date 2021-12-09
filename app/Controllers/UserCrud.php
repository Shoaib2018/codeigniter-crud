<?php 
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class UserCrud extends BaseController
{
    // show users list
    public function index(){
        $userModel = new UserModel();
        $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();

        //php
        //return view('users', $data);

        //twig
        return $this->twig->render('users.twig', $data);
    }

    // add user form
    public function create(){
        //return view('add_user');
        return $this->twig->render('add_user.twig');
    }
 
    // insert data
    public function store() {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $userModel->insert($data);
        return $this->response->redirect(site_url('/users-list'));
    }

    // show single user
    public function singleUser($id = null){
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $id)->first();
        //return view('edit_user', $data);
        return $this->twig->render('edit_user.twig', $data);
    }

    // update user data
    public function update(){
        $userModel = new UserModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $userModel->update($id, $data);
        return $this->response->redirect(site_url('/users-list'));
    }
 
    // delete user
    public function delete($id = null){
        $userModel = new UserModel();
        $data['user'] = $userModel->where('id', $id)->delete($id);
        return $this->response->redirect(site_url('/users-list'));
    }    
}