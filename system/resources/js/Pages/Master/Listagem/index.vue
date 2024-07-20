<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const exibirModal = ref(false);
const nomeInput = ref(null);

const form = useForm({
    nome: '',
});

const abrirModal = () => {
    exibirModal.value = true;
    nextTick(() => nomeInput.value.focus());
};

const cadastrarLista = () => {
    form.post(route('listagem.cadastrar'), {
        preserveScroll: true,
        onSuccess: (page) => {
            const newItem = page.props.lista;
            if (newItem) {
                itens.value.push(newItem);
            }
            closeModal();
        },
        onError: () => nomeInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    exibirModal.value = false;
    form.reset();
};

// Obtenha os props da página atual
const { props } = usePage();
const lista = ref(props.lista);
const itens = ref(props.listaCompras);

</script>

<template>
    <Head title="Listagem" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="m-0">Lista de compras</h2>
        </template>

        <div class="col-sm-12">
            <button @click="abrirModal" class="btn btn-info snRegular btn-block" style="border-radius: 20px;">
                CRIE UMA NOVA LISTAGEM
            </button>
        </div>

        <div v-if="itens.length" class="col-sm-12">
            <br>
            <table class="table" border="0">
                <tbody>
                    <tr v-for="item in itens" :key="item.id">
                        <Link :href="route('listagem.index', { lista_id: item.id })" class="link snRegular text-white">
                            <td style="border-radius: 20px; border: none; display: block; width: 100%;" class="bg-success mb-2">
                                <i class="fa fa-list"></i>&nbsp;
                                <strong>{{ item.nome }}</strong>
                            </td><br>
                        </Link>
                    </tr>
                </tbody>
            </table>
        </div>

        <Modal :show="exibirModal">
            <div class="row mt-2">
                <div class="col-12">
                    <label class="form-label snRegular">Nome da lista</label>
                    <TextInput
                        id="nome"
                        ref="nomeInput"
                        type="text"
                        v-model="form.nome"
                        class="form-control"
                        placeholder="Escreva um nome para sua listagem"
                    />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <button type="button" class="btn btn-danger snRegular" @click="closeModal"> Cancelar </button>
                </div>
                <div class="col-6 text-right">
                    <button @click="cadastrarLista" class="btn btn-success snRegular">
                        Cadastrar Lista
                    </button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
