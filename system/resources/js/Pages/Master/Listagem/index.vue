<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

import { Link, useForm, usePage, Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Listagem" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="m-0">Listagem de compras</h2>
        </template>

    </AuthenticatedLayout>
</template>
