<?php 

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