<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //redirect('/users-list', 'refresh');
        //as per CI 4 use
        //return redirect()->to('users-list'); 
        
        //if you are using route then use
        return redirect()->route('users-list');
    }
}
