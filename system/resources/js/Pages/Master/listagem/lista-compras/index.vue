<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const { props } = usePage();
const exibirModal = ref(false);
const nomeInput = ref(null);
const isEditing = ref(false);
const currentItem = ref(null);

const form = useForm({
    nome: '',
});

const abrirModal = (resultado = null, item = null) => {

    if (resultado == 'editar') {
        isEditing.value = true;
        currentItem.value = item;
        form.nome = item.nome;
    } else {
        isEditing.value = false;
        form.reset();
    }

    exibirModal.value = true;
    nextTick(() => nomeInput.value.focus());
};

const cadastrarOuEditarLista = () => {
    if (isEditing.value && currentItem.value) {
        form.put(route('listagem.update', { lista_id: currentItem.value.id }), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                if (page.props.listaCompras) {
                    itens.value = page.props.listaCompras;
                }
                closeModal();
            },
            onError: () => {
                nomeInput.value.focus();
                setTimeout(() => {
                    form.clearErrors();
                }, 4000);
            },
            onFinish: () => form.reset(),
        });
    } else {
        form.post(route('listagem.cadastrar'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                if (page.props.listaCompras) {
                    itens.value = page.props.listaCompras;
                }
                closeModal();
            },
            onError: () => {
                nomeInput.value.focus();
                setTimeout(() => {
                    form.clearErrors();
                }, 4000);
            },
            onFinish: () => form.reset(),
        });
    }
};

const closeModal = () => {
    exibirModal.value = false;
    form.reset();
};

const itens = ref(props.listaCompras);

// Função para excluir a lista
const excluirLista = (itemId) => {

    if (!confirm('Tem certeza de que deseja excluir esta lista?')) {
        return
    }

    form.delete(route('listagem.excluir', { id: itemId }), {
        preserveScroll: true,
        onSuccess: () => {
            // Atualizar a lista após a exclusão
            itens.value = itens.value.filter(item => item.id !== itemId);
        }
    });
};

// Variáveis para controlar o temporizador
let pressTimer = null;

const iniciarTemporizador = (itemId) => {
    pressTimer = setTimeout(() => excluirLista(itemId), 1200);
};

const cancelarTemporizador = () => {
    clearTimeout(pressTimer);
};
</script>

<template>
    <Head title="Listagem" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="m-0">Listagens</h2>
        </template>

        <button @click="abrirModal('cadastrar')" class="btn btn-adicionar-lista snRegular btn-block">
            <i class="fa fa-plus-circle">&nbsp;</i>
            CRIE UMA NOVA LISTAGEM
        </button>

        <br>

        <div v-if="itens.length">
            <div class="mb-3" v-for="item in itens" :key="item.id">
                <div class="text snRegular boxList"
                    @click="abrirModal('editar', item)"
                    @mousedown="iniciarTemporizador(item.id)"
                    @mouseup="cancelarTemporizador"
                    @mouseleave="cancelarTemporizador"
                    @touchstart="iniciarTemporizador(item.id)"
                    @touchend="cancelarTemporizador"
                >
                    <i class="fa fa-edit"></i>&nbsp; {{ item.nome }}
                </div>
                <Link :href="route('lista-produto.index', { id: item.id })">
                    <i class="fa fa-list iconList"></i>
                </Link>
            </div>
        </div>


        <Modal :show="exibirModal" :title="isEditing ? 'Editar Lista' : 'Cadastrar Lista'" @close="closeModal">
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
                    <InputError :message="form.errors.nome" class="mt-2" />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <button type="button" class="btn btn-danger snRegular" @click="closeModal"> Cancelar </button>
                </div>
                <div class="col-6 text-right">
                    <button @click="cadastrarOuEditarLista"
                        class="btn btn-success snRegular"
                        :class="{ 'disabled': form.processing }"
                        :disabled="form.processing"
                        >
                        {{ isEditing ? 'Editar Lista' : 'Cadastrar Lista' }}

                    </button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

