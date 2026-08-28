<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class SupabaseStorage
{
    public static function disk(string $bucket = 'post-image')
    {
        return Storage::build([
            'driver' => 's3',
            'key' => config('filesystems.disks.supabase.key'),
            'secret' => config('filesystems.disks.supabase.secret'),
            'region' => config('filesystems.disks.supabase.region'),
            'bucket' => $bucket,
            'endpoint' => config('filesystems.disks.supabase.endpoint'),
            'url' => config('filesystems.disks.supabase.url') . "/$bucket/",
            'use_path_style_endpoint' => true,
            'throw' => false,
        ]);
    }
}
