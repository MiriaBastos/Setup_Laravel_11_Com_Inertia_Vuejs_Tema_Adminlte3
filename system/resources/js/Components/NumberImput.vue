<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: number,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="form-control snRegular"
        v-model="model"
        ref="input"
    />
</template>
