@section('meta_description', 'Masuk ke akun Artikula untuk mengelola dan membaca konten.')

<div>
    <x-ui.alert />
    <form wire:submit.prevent="authenticate" class="space-y-3">
        <x-form.input type="email" name="email" placeholder="Your email" label="Email Address" />
        <x-form.input-password />
        <x-ui.submit-button target="authenticate">
            Sign in
        </x-ui.submit-button>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
        Don’t have an account?
        <a wire:navigate.hover href="/sign-up"
            class="font-medium text-emerald-600 hover:text-emerald-700 hover:underline focus:outline-none focus:ring-2 focus:ring-emerald-500/40 rounded">
            Create one
        </a>
    </p>
</div>
