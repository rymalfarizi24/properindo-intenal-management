@section('meta_description', 'Buat akun Artikula dan mulai berbagi serta membaca artikel.')

<div>
    <form wire:submit.prevent='store' class="space-y-3">
        <x-form.input type="email" name="email" placeholder="Your email" label="Email Address" />
        <x-form.input type="text" name="name" placeholder="Your name" label="Name" />
        <x-form.input type="text" name="username" placeholder="Your username" label="Username" />

        <x-form.input-password name="password" label="Password" />
        <x-form.input-password name="password_confirmation" placeholder="Confirm your password"
            label="Confirm Password" />

        <x-ui.submit-button target="store">Create</x-ui.submit-button>
    </form>
    <p class="mt-10 text-center text-sm text-gray-500">
        Already have an account?
        <a wire:navigate.hover href="/sign-in"
            class="font-medium text-emerald-600 hover:text-emerald-700 hover:underline focus:outline-none focus:ring-2 focus:ring-emerald-500/40 rounded">
            Sign In
        </a>
    </p>
</div>
