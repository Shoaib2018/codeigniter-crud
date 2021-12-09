<?php 

namespace App\Controllers;  
use CodeIgniter\Controller;

use App\Models\AdminModel;

  
class RegisterController extends BaseController
{
    public function index()
    {
        helper(['form']);
        $data = [];
        //echo view('registration', $data);
        return $this->twig->render('registration.twig');
    }
  
    public function store()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
          
        if($this->validate($rules)){
            $model = new AdminModel();
            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            ];
            $model->save($data);
            return redirect()->to('/login');
        }else{
            $data['validation'] = $this->validator;
            
            //echo view('registration', $data);
            
            //echo $data['validation']->listErrors();       //all
            //echo $data['validation']->getError('name');   //single

            return $this->twig->render('registration.twig', $data);
        }
    }
}