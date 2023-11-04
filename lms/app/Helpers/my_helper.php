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
    if ($oldval === $value) {
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
 * Upload picture user.
 *
 * @param  mixed $picture
 * @param  mixed $path
 * @return string
 */
function upload_picture($picture, $path)
{
    $pictureName = "picture.png";

    if ($picture->getError() != 4) {
        $pictureName = $picture->getRandomName();

        Services::image()
            ->withFile($picture)
            ->resize(400, 400, true, 'height')
            ->save("$path/$pictureName");
    }

    return $pictureName;
}