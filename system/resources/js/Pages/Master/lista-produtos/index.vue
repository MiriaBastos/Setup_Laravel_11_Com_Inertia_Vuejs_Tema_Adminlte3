<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const { props } = usePage();

</script>

<template>
    <Head title="lista Itens" />

    <AuthenticatedLayout>
        <template #header>
            <div class="col-4">
                <h2 class="m-0">Lista Itens</h2>
            </div>
            <div class="col-4 text-right" style="padding-top: 4px;">
                <Link :href="route('listagem.index')" class="btn btn-info btn-sm snRegular">
                    VOLTAR
                </Link>
            </div>
        </template>

        <div class="col-12">
            Aqui vai ficar a lista de itens/produtos
        </div>
    </AuthenticatedLayout>
</template>
