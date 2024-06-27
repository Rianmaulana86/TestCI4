<?php

namespace App\Controllers\Main;

use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

     protected $modelName = 'App\Models\UserModel';
     protected $format    = 'json';


    public function index()
    {
        $users = $this->model->findAll();
         // Menambahkan nomor urut ke setiap item
         $i = 1;
         foreach ($users as &$user) {
             $user['no'] = $i++;
         }
 
        $data['user'] = $users;
        return view('main/users/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $data['user'] = $this->model->find($id);
        return view('users/show', $data);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('main/users/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {

    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $user = $this->model->find($id);

        if($user) {
            return view('main/users/edit', ['data' => $user]);
        } else {
            session()->setFlashdata('message', 'User Tidak Di Temukan');
            session()->setFlashdata('alertType', 'error');
            return redirect()->back();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {

        

        $user = $this->model->find($id);
        if (empty($this->request->getVar('password'))) {

            $rules = [
                'username' => 'required|min_length[6]',
                'email' => 'required|valid_email|is_unique[users.email]',
            ];
    
            if (!$this->validate($rules)) {
                session()->setFlashdata('message', implode($this->validator->getErrors()));
                session()->setFlashdata('alertType', 'error');
                return redirect()->back();
            }
            
            $data = [
                'username' => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => $user['password'],
            ];

        } else {

            $rules = [
                'username' => 'required|min_length[6]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'min_length[6]'
            ];
    
            if (!$this->validate($rules)) {
                session()->setFlashdata('message', implode($this->validator->getErrors()));
                session()->setFlashdata('alertType', 'error');
                return redirect()->back();
            }

            $password = $this->request->getVar('password');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'username' => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' =>  $hashedPassword
            ];
        }

       

        if ($this->model->update($id, $data)) {
            session()->setFlashdata('message', 'Berhasil Update');
            session()->setFlashdata('alertType', 'success');
            return redirect()->back();
        } else {
            session()->setFlashdata('message', 'Gagal Update');
            session()->setFlashdata('alertType', 'error');
            return redirect()->back();
        }
        
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        session()->setFlashdata('message', 'Berhasil Hapus');
        session()->setFlashdata('alertType', 'success');
        return redirect()->back();
    }
}
