<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

import { Link, useForm, usePage, Head } from '@inertiajs/vue3';


const form = useForm({
  categoria_id: '',
  descricao: '',
  dt_dia: '',
  dt_mes: '',
  dt_ano: '',
  valor_despesa: '',
  despesa_recorrente: false,
});


</script>

<template>
    <Head title="Cadastrar" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="m-0">Cadastrar Despesa</h2>
        </template>

        <form @submit.prevent="form.post(route('despesas.cadastrar'))">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-check">
                            <input v-model="form.despesa_recorrente" class="form-check-input" type="checkbox" id="recorrencia_id">
                            <label class="form-check-label" for="recorrencia_id">
                                Marcar caso essa dívida seja recorrente em suas despesas
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <label for="name" class="form-label snRegular">Dia</label>

                        <input
                            type="number"
                            class="form-control"
                            v-model="form.dt_dia"
                            required
                        >

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label snRegular">Mês</label>
                        <select v-model="form.dt_mes" class="form-control">
                            <option value="">Selecione um mês</option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                        </select>

                    </div>
                    <div class="col-sm-2">
                        <label class="form-label snRegular">Ano</label>
                        <select v-model="form.dt_ano" class="form-control">
                            <option value="">Selecione um ano</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="form-label snRegular">Categorio</label>
                        <select v-model="form.categoria_id" class="form-control">
                            <option value="">Selecione a categoria</option>
                            <option value="1">Lazer</option>
                            <option value="2">Compras</option>
                            <option value="3">Sáude</option>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <label class="form-label snRegular">Valor</label>
                        <input
                            type="number"
                            class="form-control"
                            v-model="form.valor_despesa"
                            required
                        >
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label snRegular">Descrição</label>
                        <TextInput
                            id="descricao"
                            type="text"
                            v-model="form.descricao"
                            required
                            autofocus
                            autocomplete="descricao"
                        />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12 text-end">
                        <button type="submit" class="btn btn-success snRegular">Cadastrar Despesa</button>
                    </div>
                </div>
            </form>

    </AuthenticatedLayout>
</template>
