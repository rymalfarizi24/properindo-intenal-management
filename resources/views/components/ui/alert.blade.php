<div x-cloak x-data="{ isShow: false, message: '', type: 'success', color: { success: 'text-fg-success-strong bg-success-soft border-success-subtle', danger: 'text-fg-danger-strong bg-danger-soft border border-danger-subtle', warning: 'text-fg-warning bg-warning-soft border-warning-subtle' } }" x-show="isShow"
    x-on:alert.window="console.log('ok'); isShow = true; message = $event.detail.message; type = $event.detail.type;"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
    class="flex items-start sm:items-center p-4 mb-4 text-sm rounded-base border" :class="color[type]" role="alert">
    <x-icons.info size="16" class="me-2 shrink-0 mt-0.5 sm:mt-0" />
    <p x-text="message"></p>
</div>
