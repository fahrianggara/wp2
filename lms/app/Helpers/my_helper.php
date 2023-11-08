<?php

use App\Models\TeacherModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Config\Services;

/**
 * Selected option for form select.
 *
 * @param  mixed $oldval
 * @param  mixed $value
 * @return void
 */
function selected_option($oldval, $value)
{
    if ($oldval == $value) {
        return 'selected';
    }
}

/**
 * Remove underscore from string.
 *
 * @param  mixed $string
 * @return void
 */
function remove_underscore($string)
{
    return str_replace('_', ' ', ucwords($string));
}

/**
 * uppercase from string.
 *
 * @param  mixed $string
 * @return void
 */
function upcase($string)
{
    return strtoupper($string);
}

/**
 * Get full name of user.
 *
 * @param  mixed $user
 * @return void
 */
function full_name($user)
{
    return $user->first_name . ' ' . $user->last_name;
}

/**
 * Get picture user.
 * 
 * @param  mixed $user
 * @param mixed $path
 * @return void
 */
function picture($user, $path)
{
    $path = "$path/$user->picture";
    return file_exists($path) ? base_url($path) : base_url('images/picture.png');
}

/**
 * Upload picture user.
 *
 * @param  mixed $request
 * @param  mixed $path
 * @param  mixed $old_picture
 * @param  mixed $upload
 * @return string
 */
function upload_picture($request, $path, $old_picture = null, $upload = false)
{
    $picture = $request->getFile('picture');
    $pictureName = $old_picture ?? 'picture.png';
    
    if ($picture->getError() != 4) 
    {
        $pictureName = $picture->getRandomName();

        Services::image()
            ->withFile($picture)
            ->resize(400, 400, true, 'height')
            ->save("$path/$pictureName");

        if ($old_picture && $upload) {
            destroy_file($old_picture, $path);
        }
    }

    return $pictureName;
}

/**
 * Upload file
 * 
 * @param  mixed $request
 * @param  mixed $path
 * @param  mixed $old_file
 * @param  mixed $upload
 * @return string
 */
function upload_file($request, $path, $old_file = null, $upload = false)
{
    $file = $request->getFile('file');
    $fileName = $old_file ?? 'file.pdf';

    if ($file->getError() !== 4) 
    {
        $fileName = $file->getRandomName();
        $file->move($path, $fileName);

        if ($old_file && $upload) {
            destroy_file($old_file, $path);
        }
    }

    return $fileName;
}

/**
 * Destroy file from storage.
 * 
 * @param  mixed $filename
 * @param mixed $path
 * @return void
 */
function destroy_file($filename, $path)
{
    $pathUrl = "$path/$filename";
    if (file_exists($pathUrl)) unlink($pathUrl);
}

/**
 * Get user info.
 *
 * @param  mixed $user
 * @return void
 */
function user_info($user) 
{
    if (!$user) return "<span class='badge badge-danger'>Tidak ada</span>";
    
    return "
        <div class='user-info'>
            <img src='$user->photo'>
            <div class='user-name'>
                <span>$user->full_name</span>
                <small>$user->id_number</small>
            </div>
        </div>
    ";
}

/**
 * Time format H:i Carbon
 *
 * @param string $time
 * @return string
 */
function time_format($time, $wib = true) {
    $wib = $wib == true ? ' WIB' : '';
    return Carbon::parse($time)->translatedFormat('H:i') . $wib;
}

/**
 * Helper teacher()
 */
function teacher()
{
    $session = session();

    if ($session->role !== 'teacher') 
        return null;

    $teacherModel = new TeacherModel();
    return $teacherModel->where('user_id', $session->id)->with(['users'])->first();
}