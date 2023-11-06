<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return view('profile/index', [
            'title' => 'Profile',
            'menu' => 'profile',
            'user' => $this->auth
        ]);
    }

    /**
     * Change photo profile
     * 
     * @return void
     */
    public function changePhoto()
    {
        $request = $this->request;

        $rules = [
            'picture' => [
                'rules' => 'uploaded[picture]|max_size[picture,1024]|mime_in[picture,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu.',
                    'max_size' => 'Ukuran gambar maksimal 1MB.',
                    'mime_in' => 'Format gambar harus jpg, jpeg, atau png.'
                ]
            ],
        ];

        if (!$this->validate($rules)) {
            return response()->setJSON([
                'status' => 400,
                'message' => $this->validator->getError('picture')
            ]);
        }

        $this->db->transBegin();
        try {
            $old_picture = $this->auth->picture;
            $pictureName = ($request->getFile('picture') !== 4)
                ? upload_picture($request,'images/pictures', $old_picture, true)
                : $old_picture;

            $this->userModel->save([
                'id'      => $this->auth->id,
                'picture' => $pictureName
            ]);

            return response()->setJSON([
                'status'=> 200,
                'message' => 'Foto profile kamu berhasil diubah.'
            ]);
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        } finally {
            $this->db->transCommit();
        }
    }

    /**
     * Remove photo profile
     * 
     * @return void
     */
    public function removePhoto()
    {
        $this->db->transBegin();
        try {
            $old_picture = $this->auth->picture;
            $path = 'images/pictures';
            if (file_exists("$path/$old_picture")) unlink("$path/$old_picture");

            $this->userModel->save([
                'id'      => $this->auth->id,
                'picture' => 'picture.png'
            ]);

            return response()->setJSON([
                'status'=> 200,
                'message' => 'Foto profile kamu berhasil dihapus.'
            ]);
        } catch (\Throwable $th) {
            $this->db->transRollback();

            return response()->setJSON([
                'status' => 400,
                'message' => $th->getMessage()
            ]);
        } finally {
            $this->db->transCommit();
        }
    }
}
