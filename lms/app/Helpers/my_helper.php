<?php 

function selected_option($oldval, $value)
{
    if ($oldval === $value) {
        return 'selected';
    }
}

function remove_underscore($string)
{
    return str_replace('_', ' ', ucwords($string));
}

function full_name($user)
{
    return $user->first_name . ' ' . $user->last_name;
}   