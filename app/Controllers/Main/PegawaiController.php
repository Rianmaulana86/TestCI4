<?php

namespace App\Controllers\Main;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class PegawaiController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */

     protected $modelName = 'App\Models\PegawaiModel';


    public function index()
    {
        $pegawai = $this->model->findAll();
        
        // Menambahkan nomor urut ke setiap pegawai
        $i = 1;
        foreach ($pegawai as &$peg) {
            $peg['no'] = $i++;
        }
        
        $data['pegawai'] = $pegawai; // Mengirim semua pegawai ke view

        return view('main/pegawai/index', $data);
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
        return view('pegawai/show', $data);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        return view('main/pegawai/create');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,300]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('message', implode($validation->getErrors()));
            session()->setFlashdata('alertType', 'error');
            return redirect()->back();
        }


        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $imageName);

            // Pindahkan file dari writable ke public/uploads
            if (!is_dir(FCPATH . 'uploads')) {
                mkdir(FCPATH . 'uploads', 0777, true);
            }
            rename(WRITEPATH . 'uploads/' . $imageName, FCPATH . 'uploads/' . $imageName);
        } else {
            $imageName = null;
        }

        // Simpan data ke database
        $this->model->save([
            'name' => $this->request->getPost('name'),
            'addres' => $this->request->getPost('addres'),
            'age' => $this->request->getPost('age'),
            'gender' => $this->request->getPost('gender'),
            'addres' => $this->request->getPost('addres'),
            'image' => $imageName
        ]);

        session()->setFlashdata('message', 'Berhasil Buat Data Pegawai');
        session()->setFlashdata('alertType', 'success');
        return redirect()->back();

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
        $pegawai = $this->model->find($id);

        if($pegawai) {
            return view('main/pegawai/edit', ['data' => $pegawai]);
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

        $validation = \Config\Services::validation();
        $validation->setRules([
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,300]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('message', implode($validation->getErrors()));
            session()->setFlashdata('alertType', 'error');
            return redirect()->back();
        }

        $pegawai = $this->model->find($id);

        $file = $this->request->getFile('image');

        if ($file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $imageName);

            // Pindahkan file dari writable ke public/uploads
            if (!is_dir(FCPATH . 'uploads')) {
                mkdir(FCPATH . 'uploads', 0777, true);
            }
            rename(WRITEPATH . 'uploads/' . $imageName, FCPATH . 'uploads/' . $imageName);
        } else {
            $imageName = $pegawai['image'];
        }

        $this->model->update($id, [
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'age' => $this->request->getVar('age'),
            'gender' => $this->request->getVar('gender'),
            'image' => $imageName,
        ]);

        session()->setFlashdata('message', 'Berhasil Edit Data Pegawai');
        session()->setFlashdata('alertType', 'success');
        return redirect()->back();

       
        
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
