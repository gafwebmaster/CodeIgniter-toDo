<?php

namespace App\Controllers;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [];        
        
        echo view('header', $data);
        echo view('nav');
        echo view('pages/dashboard');
        echo view('footer');
    }  
}
