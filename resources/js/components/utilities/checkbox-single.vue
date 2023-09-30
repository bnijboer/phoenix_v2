<template>
    <div class="field-checkbox">
        <Checkbox
            v-model="checked"
            binary
            :id="id"
            :label="label"
        />

        <label
            v-if="label && id"
            :for="id"
            class="ml-2 text-sm text-gray-600"
        >
            {{ label }}
        </label>
    </div>
</template>

<script setup>
    import Checkbox from 'primevue/checkbox';
    import {useModelWrapper} from "@/helpers/model-wrapper";

    const props = defineProps({
        modelValue: String,
        id: String,
        label: String,
    });

    const emit = defineEmits(['update:modelValue']);

    const checked = useModelWrapper(props, emit, 'modelValue');
</script>
