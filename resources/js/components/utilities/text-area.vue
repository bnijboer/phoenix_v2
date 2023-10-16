<template>
    <div>
        <div class="p-float-label">
            <Textarea
                v-model="body"
                :id="id"
                :label="label"
                :class="{ 'p-invalid': isInvalid }"
                :required="required"
                class="w-full h-8rem"
            />

            <label
                v-if="label && id"
                :for="id"
                class="text-sm text-gray-600"
            >
                {{ label }}
            </label>
        </div>
    </div>
</template>

<script setup>
    import {computed} from 'vue';
    import Textarea from 'primevue/textarea';
    import {useModelWrapper} from "@/helpers/model-wrapper";

    const props = defineProps({
        modelValue: String,
        id: String,
        label: String,
        error: String,
        required: {
            type: Boolean,
            default: false
        }
    });

    const emit = defineEmits(['update:modelValue']);

    const body = useModelWrapper(props, emit, 'modelValue');

    const isInvalid = computed(() => !!props.error);
</script>
