<template>
    <form @submit.prevent="onSubmit">
        <slot />
    </form>
</template>

<script setup>
    import errorMessages from "../../config/validation-errors";

    const props = defineProps({
        rules: {
            type: Object,
        },
        form: {
            type: Object,
        }
    });

    const emit = defineEmits(['validated']);

    function onSubmit() {
        const errors = validate(props.form);

        emit('validated', errors);
    }

    function validate(data) {
        const errors = {};

        for (const [key, value] of Object.entries(data)) {
            props.rules[key].forEach(rule => {
                console.log(rule.name);
                console.log(value);
                if (!rule(value)) {
                    // console.log('test');
                    errors[key] = errorMessages[rule.name];
                }
            });
        }

        return errors;
    }
</script>
