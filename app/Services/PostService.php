<?php

namespace App\Services;

use App\Models\Post;
use App\Support\SupabaseStorage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class PostService
{
    public function deletePost(int $id): bool
    {
        $post = Post::find($id, ['image']);

        if (!$post) {
            return false;
        }

        if ($post->image) {
            $response = SupabaseStorage::disk('post-image')->delete($post->image);

            if (!$response) {
                return false;
            }
        }

        Post::destroy($id);
        return true;
    }

    public function createPost($data, TemporaryUploadedFile $image): bool
    {
        if ($image) {
            $path = SupabaseStorage::disk('post-image')->putFile('', $image, 'public');
            if (!$path) {
                return false;
            }

            $data['image'] = $path;
        }

        $data['author_id'] = auth()->user()->id;
        Post::create($data);

        return true;
    }

    public function editPost(int $id, array $data, TemporaryUploadedFile | null $image, string | null $lastImage): bool
    {
        if ($image instanceof TemporaryUploadedFile) {
            if ($lastImage) {
                // Delete object
                $deleteResponse = SupabaseStorage::disk('post-image')->delete($lastImage);

                if (!$deleteResponse) {
                    return false;
                }
            }

            // Upload Image
            $path = SupabaseStorage::disk('post-image')->putFile('', $image, 'public');

            if (!$path) {
                return false;
            }

            $data['image'] = $path;
        } else {
            unset($data['image']);
        }

        // Update data
        Post::where('id', $id)->update($data);

        return true;
    }
}
