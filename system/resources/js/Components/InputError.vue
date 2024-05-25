<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm alert alert-danger text-sm">
            {{ message }}
        </p>
    </div>
</template>
