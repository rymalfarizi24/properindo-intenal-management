@section('meta_description', 'Masuk ke akun Artikula untuk mengelola dan membaca konten.')

<div>
    <x-ui.alert />
    <form wire:submit.prevent="authenticate" class="space-y-3">
        <x-form.input type="text" name="email" placeholder="Your email" label="Email Address" />
        <x-form.input-password />
        <x-ui.submit-button target="authenticate">
            Sign in
        </x-ui.submit-button>
    </form>
</div>