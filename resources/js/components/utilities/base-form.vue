<template>
    <form @submit.prevent="onSubmit">
        <slot />
    </form>
</template>

<script setup>
    import ErrorMessages from "../../config/validation-errors";
    import ValidationRules from "../../config/validation-rules";

    const props = defineProps({
        rules: {
            type: Object,
        },
        request: {
            type: Object,
        }
    });

    const emit = defineEmits(['validate']);

    function onSubmit() {
        const errors = validate(props.request);

        const form = {
            validated: Object.keys(errors).length === 0,
            errors: errors,
        }

        emit('validate', form);
    }

    function validate(data) {
        const errors = {};

        for (const [key, value] of Object.entries(data)) {
            props.rules[key].forEach(item => {
                const _rule = item.split(':');

                const rule = _rule.shift();
                const param = _rule.shift();

                if (!ValidationRules[rule](value, param)) {
                    // errors.push({[key]: ErrorMessages[rule]});
                    errors[key] = ErrorMessages[rule](param);
                }
            });
        }

        return errors;
    }
</script>
