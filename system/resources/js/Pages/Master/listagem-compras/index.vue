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

        <div class="col-sm-12">
            <button @click="abrirModal('cadastrar')" class="btn btn-info snRegular btn-block" style="border-radius: 20px;">
                CRIE UMA NOVA LISTAGEM
            </button>
        </div>

        <div v-if="itens.length" class="col-sm-12">
            <br>
            <table class="table" border="0">
                <tbody>
                    <tr v-for="item in itens" :key="item.id">
                        <td
                            style="border-radius: 20px; border: none; display: block; width: 100%; cursor: pointer;"
                            class="bg-success mb-2 link snRegular text-white"
                            @click="abrirModal('editar', item)"
                            @mousedown="iniciarTemporizador(item.id)"
                            @mouseup="cancelarTemporizador"
                            @mouseleave="cancelarTemporizador">
                            <i class="fa fa-list"></i>&nbsp;
                            {{ item.nome }}
                        </td>
                        <td style="border: none;">
                            <Link :href="route('lista-produto.index', { id: item.id })">
                                <div style="background: #9d9db9; text-align: center; padding: 4px 1px; border-radius: 16px; color: #ffff; cursor: pointer;">
                                    <i class="fa fa-arrow-circle-right"></i>
                                </div>
                            </Link>
                        </td>
                        <br>
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
                        {{ isEditing.value ? 'Editar Lista' : 'Cadastrar Lista' }}

                    </button>
                </div>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>

