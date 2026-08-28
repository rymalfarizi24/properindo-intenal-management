<div>
    <x-title>{{ $isEdit ? 'Edit Post' : 'Create New Post' }}</x-title>
    <form wire:submit.prevent='save' class="max-w-full grid md:grid-cols-2 gap-x-4 gap-y-2 pb-4"
        x-data="{ title: @entangle('title'), slug: @entangle('slug') }">
        @csrf
        {{-- Title --}}
        <x-form.input name="title" label="Title" :autofocus='true' type='text' class='col-span-full' />
        {{-- Slug --}}
        <x-form.slug-input target='slug' from='title' label='Slug' />
        {{-- Category --}}
        <x-form.select-input :data="$categories" option="name" name="category_id" label="Category"
            empty="Choose category" />

        {{-- Post Image --}}
        <div x-data="imagePreview()" class="col-span-full">
            <img x-show="imageUrl" :src="imageUrl" class="mb-3 mx-auto max-w-xl object-cover max-h-96">
            <label class="block mb-2.5 text-sm font-medium text-heading" for="image">Post Image</label>
            <input @change="previewImage" wire:model='image' name="image" id="image" type="file" accept="image/*"
                class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600 block w-full shadow-xs placeholder:text-body">
            <p class="@error('image') text-xs text-red-600 @else text-sm text-gray-500 @enderror mt-0.5 h-4">
                @error('image')
                {{ $message }}
                @else
                JPG, JPEG, PNG, BMP, GIF, or WEBP (MAX. 1 MB).
                @enderror
            </p>
        </div>

        {{-- Body --}}
        <div wire:ignore class="col-span-full">
            <label for="body" class="block text-sm/6 font-medium text-gray-900">Body</label>
            <input wire:model='body' class="post-body" id="body" type="hidden" name="body">
            <trix-editor input="body" x-data x-init="$nextTick(() => {
                const editor = $el.editor;
                editor.loadHTML(@js($body));
            })" x-on:trix-change="$wire.set('body', $event.target.value)"></trix-editor>
        </div>
        <p class="text-xs text-red-600 h-4">
            @error('body')
            {{ $message }}
            @enderror
        </p>

        {{-- Submit --}}
        <x-ui.submit-button target="image,save,body" class="col-span-full">{{ $isEdit ? 'Edit' : 'Create New' }}
            Post</x-ui.submit-button>
    </form>
</div>

<script>
    function imagePreview() {
        return {
            imageUrl: @js(isset($imgPath) ? $imgPath : null),
            previewImage(e) {
                const file = e.target.files[0];
                if (file) {
                    this.imageUrl = URL.createObjectURL(file);
                } else {
                    this.imageUrl = null;
                }
            }
        }
    }

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })
</script>