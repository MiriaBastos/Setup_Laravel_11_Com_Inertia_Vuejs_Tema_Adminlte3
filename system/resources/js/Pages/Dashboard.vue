<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <!-- <template #header>
            <h2 class="m-0">Dashboard</h2>
        </template> -->

        <div class="snRegular text-center">
            Seja bem vindo ao Despesas App. <br>
            Um sistema onde você conseguirar controlar suas despesas e gastos <br>
            Feito por: Rafael e Miriã
        </div>

    </AuthenticatedLayout>
</template>
