<?php

if (! function_exists('isImage')) {
    function isImage($extension)
    {
        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
    }
}
