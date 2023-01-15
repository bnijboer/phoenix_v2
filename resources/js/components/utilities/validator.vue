<template>
    <form @submit.prevent="onSubmit">
        <slot />
    </form>
</template>

<script setup>
    import errorMessages from "../../config/validation-errors";
    import ValidationRules from "../../config/validation-rules";

    const props = defineProps({
        rules: {
            type: Object,
        },
        request: {
            type: Object,
        }
    });

    const emit = defineEmits(['validated']);

    function onSubmit() {
        const form = {
            data: props.request,
            errors: validate(props.request)
        }

        emit('validated', form);
    }

    function validate(data) {
        const errors = {};

        for (const [key, value] of Object.entries(data)) {
            props.rules[key].forEach(item => {
                const _rule = item.split(':');

                const rule = _rule.shift();
                const param = _rule.shift();

                if (!ValidationRules[rule](value, param)) {
                    errors[key] = errorMessages[rule];
                }
            });
        }

        return errors;
    }
</script>
