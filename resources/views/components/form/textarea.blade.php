@props([
    'type' => 'text',
    'name',
    'placeholder' => '',
    'label',
    'class' => '',
])

<div class="{{ $class }}">
    <x-form.label :name="$name">{{ $label }}</x-form.label>

    <textarea rows="5" wire:model='{{ $name }}'
        class="w-full px-4 py-2.5 border rounded-lg focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-600"
        placeholder="{{ $placeholder }}"></textarea>

    <x-form.error-validation :name="$name" />
</div>
