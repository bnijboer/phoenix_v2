<template>
    <div>
        <div class="field">
            <label
                v-if="label && id"
                :for="id"
                class="text-sm text-gray-600"
            >
                {{ label }}
            </label>

            <InputText
                v-model="message"
                :id="id"
                :type="type"
                :placeholder="placeholder"
                :label="label"
                :class="{ 'p-invalid': isInvalid }"
                :required="required"
                class="w-full"
            />
        </div>

        <validation-section
            v-if="error"
            :error="error"
        />
    </div>
</template>

<script setup>
    import {computed} from 'vue';
    import InputText from 'primevue/inputtext';
    import ValidationSection from "@/components/utilities/validation-section.vue";
    import {useModelWrapper} from "@/helpers/model-wrapper";

    const props = defineProps({
        modelValue: String,
        id: String,
        type: String,
        placeholder: String,
        label: String,
        isInvalid: Boolean,
        error: String,
        required: {
            type: Boolean,
            default: false
        }
    });

    const emit = defineEmits(['update:modelValue']);

    const message = useModelWrapper(props, emit, 'modelValue');

    const isInvalid = computed(() => !!props.error);
</script>
