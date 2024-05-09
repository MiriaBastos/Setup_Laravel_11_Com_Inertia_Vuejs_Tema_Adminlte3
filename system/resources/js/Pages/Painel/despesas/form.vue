<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Editar" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="m-0">Editar cadastro</h2>
        </template>

        <div class="row">
            <div class="col-sm-12">
                <h2>Aqui vai ficar o formulario de edição</h2>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
