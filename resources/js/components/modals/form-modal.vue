<template>
    <vue-final-modal
        v-slot="{ params, close }"
        v-bind="$attrs"
        classes="flex justify-center items-center"
        content-class="relative flex flex-col max-h-full mx-4 p-4 border dark:border-gray-800 rounded bg-white dark:bg-gray-900 w-96"
    >
        <span class="mr-8 text-2xl font-bold">
            <slot name="title"></slot>
        </span>

        <div class="flex-grow overflow-y-auto my-8">
            <slot :params="params"></slot>
        </div>

        <div class="flex-shrink-0 flex justify-between items-center pt-4">
            <button
                class="btn-default"
                @click="$emit('cancel', close)"
            >
                {{ actions.cancel }}
            </button>

            <button
                class="btn-success"
                @click="$emit('confirm', close)"
            >
                {{ actions.confirm }}
            </button>
        </div>
    </vue-final-modal>
</template>

<script>
    export default {
        name: 'VTailwindModal',
        inheritAttrs: false,
        emits: ['cancel', 'confirm'],
        props: ['actions'],
    }
</script>
