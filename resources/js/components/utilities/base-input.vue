<template>
    <div>
        <label :for="props.name" class="block font-medium text-sm text-gray-700 mb-2">
            <slot />
        </label>

        <input
            @input="$emit('update:modelValue', $event.target.value)"
            :value="modelValue"
            :type="props.type"
            :name="props.name"
            :placeholder="props.placeholder"
            :required="props.required"
            :autofocus="props.autofocus"
            ref="input"
            class="block w-full p-2 border border-gray-300 focus:border-indigo-300 rounded-md shadow-sm"
        />
    </div>
</template>

<script setup>
    import {onMounted, ref} from 'vue';

    const props = defineProps({
        modelValue: String,
        name: String,
        type: String,
        placeholder: String,
        required: Boolean,
        autofocus: Boolean
    });

    defineEmits(['update:modelValue']);

    const input = ref(null);

    onMounted(() => {
        if (input.value.hasAttribute('autofocus')) {
            input.value.focus();
        }
    });
</script>
