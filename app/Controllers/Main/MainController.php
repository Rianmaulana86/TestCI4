<?php

namespace App\Controllers\Main;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MainController extends BaseController
{
    public function index()
    {
        return view('main/index');
    }
}
