<div wire:ignore x-cloak x-data="{
    isShow: false,
    type: 'success',
    message: '',
    colors: {
        success: 'bg-emerald-100 text-emerald-600',
        danger: 'bg-red-100 text-red-600',
        warning: 'bg-yellow-100 text-yellow-600',
    }
}" x-show="isShow"
    x-on:toast.window="
    isShow=true;
    message=$event.detail.message;
    type=$event.detail.type;
    setTimeout(() => isShow = false, 2000);
    "
    x-transition :class="colors[type]"
    class="fixed bottom-2 right-2 flex items-center w-full max-w-sm p-4 text-body bg-neutral-primary-soft rounded-base shadow-xs border border-default"
    role="alert">
    <div class="inline-flex items-center justify-center shrink-0 w-7 h-7 rounded">
        <template x-if="type=='success'">
            <x-icons.check size="20" />
        </template>
        <template x-if="type=='danger'">
            <x-icons.danger size="20" />
        </template>
        <template x-if="type=='warning'">
            <x-icons.warning size="20" />
        </template>
    </div>
    <div class="ms-3 text-sm font-normal" x-text="message"></div>
    <button type="button" x-on:click="isShow=false"
        class="cursor-pointer ms-auto flex items-center justify-center text-body hover:text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded text-sm h-8 w-8 focus:outline-none">
        <x-icons.cross size="20" />
    </button>
</div>
