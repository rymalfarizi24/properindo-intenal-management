<?php

namespace App\Livewire\Pages\Dashboard;

use App\Models\User;
use App\Support\SupabaseStorage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.dashboard')]

class Profile extends Component
{
    use WithFileUploads;

    public $img;
    public ?string $lastImg = null;
    public string $name;
    public string $username;
    public string $job;
    public string $email;
    public bool $email_verified;
    public int $user_id;

    public function mount()
    {
        $user = auth()->user();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->job = $user->job;
        $this->email = $user->email;
        $this->lastImg = $user->img ? SupabaseStorage::disk('profile-image')->url($user->img) : null;
        $this->email_verified = (bool) $user->email_verified_at;
    }

    public function render()
    {
        return view('livewire.pages.dashboard.profile');
    }

    public function save()
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'username' => ['required', 'max:50'],
            'job' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:255'],
        ];

        if ($this->img) {
            $rules['img'] = ['image', 'max:1024'];
        }

        $validated_data = $this->validate($rules);

        if ($this->img) {
            $img_path = $this->updateProfile();
            $validated_data['img'] = $img_path;
        }

        User::where('id', $this->user_id)->update($validated_data);
        $this->dispatch('toast', type: 'success', message: 'Profile updated successfully!');
    }

    private function updateProfile()
    {
        if ($this->lastImg && SupabaseStorage::disk('profile-image')->exists($this->lastImg)) {
            SupabaseStorage::disk('profile-image')->delete(
                $this->lastImg
            );
        }
        $path = SupabaseStorage::disk('profile-image')->putFile($this->user_id, $this->img, 'public');
        return $path;
    }
}
