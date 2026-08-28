<?php

function getImage($pathName)
{
    return config('services.supabase.url') . '/storage/v1/object/public/' . config('services.supabase.bucket') . '/' . $pathName;
}
