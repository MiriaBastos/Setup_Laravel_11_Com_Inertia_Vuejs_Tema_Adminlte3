<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';
import { nextTick, ref, computed } from 'vue';

const { props } = usePage();

const nomeInput = ref(null);
const quantidadeInput = ref(null);
const valorInput = ref(null);

const exibirModal = ref(false);
const isEditing = ref(false);
const currentItem = ref(null);

// const itens = ref([
//     { id: 1, nome: 'Arroz sepe', quantidade: 1, valor: 23.99, checked: false },
//     { id: 2, nome: 'Feijão Com Brasil', quantidade: 1, valor: 8.99, checked: false },
//     { id: 3, nome: 'Oleo de soja', quantidade: 2, valor: 5.19, checked: false },
//     { id: 4, nome: 'Farinha de trigo', quantidade: 1, valor: 3.79, checked: false },
//     { id: 5, nome: 'Farinha mandioca', quantidade: 1, valor: 7.19, checked: false },
//     { id: 6, nome: 'Café Forte', quantidade: 1, valor: 8.99, checked: false },
//     { id: 7, nome: 'Leite Cond. itambe', quantidade: 3, valor: 3.99, checked: false },
// ]);

const itens = ref(props.produtoLista);


const form = useForm({
    lista_id: props.lista.id,
    nome: '',
    quantidade: '',
    valor: '',
});

const abrirModal = (resultado = null, item = null) => {

if (resultado == 'editar') {
    isEditing.value = true;
    currentItem.value = item;
    form.nome = item.nome;
    form.quantidade = item.quantidade;
    form.valor = item.valor;
} else {
    isEditing.value = false;
    form.reset();
}

exibirModal.value = true;
nextTick(() => nomeInput.value.focus());

};

const closeModal = () => {
    exibirModal.value = false;
    form.reset();
};

const cadastrarOuEditarItem = () => {
    if (isEditing.value && currentItem.value) {
        form.put(route('lista-produto.update', { produto_id: currentItem.value.id }), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                if (page.props.produtoLista) {
                    itens.value = page.props.produtoLista;
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
        form.post(route('lista-produto.cadastrar'), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                if (page.props.produtoLista) {
                    itens.value = page.props.produtoLista;
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

const valorTotal = computed(() => {
    return itens.value.reduce((total, item) => {
        return total + (item.valor * item.quantidade);
    }, 0);
});

const totalItens = computed(() => {
    return itens.value.reduce((total, item) => total + item.quantidade, 0);
});

const toggleDone = (item) => {
    item.checked = !item.checked; // Alterna o estado do item
};
</script>

<template>

    <Head title="lista Itens" />

    <AuthenticatedLayout>
        <template #header>
            <div class="col-12">
                <h3 style="display: inline-block;">Lista de produtos</h3>
                <Link :href="route('listagem.index')" class="btn btn-info btn-sm snRegular float-right mt-1">
                VOLTAR
                </Link>
            </div>
        </template>

        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fa fa-clipboard mr-1"></i>
                    Lista de Compras do Mês
                </h3>
            </div>

            <ul class="todo-list ui-sortable" data-widget="todo-list">
                <li v-for="item in itens" :key="item.id" :class="{ done: item.checked }">
                    <!-- <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox"
                                :id="`todoCheck${item.id}`"
                                v-model="item.checked"
                                @change="toggleDone(item)">
                        <label :for="`todoCheck${item.id}`"></label>
                    </div> -->

                    <span class="text">{{ item.nome }}</span>

                    <small class="badge badge-info">x{{ item.quantidade }}</small>
                    <small class="badge badge-success"> R$ {{ (item.valor * item.quantidade).toLocaleString('pt-BR', { minimumFractionDigits: 2 }) }}</small>

                    <div style="color: #dc3545; float: right; cursor: pointer;">
                        <i class="fas fa-edit" @click="abrirModal('editar', item)"></i>
                    </div>
                </li>
            </ul>

            <div class="card-footer clearfix">
                <i class="fa fa-cart-plus"></i> <span class="snRegular">Itens</span> <span class="badge badge-success">{{ totalItens }}</span>
                <i style="padding-left: 15px;" class="fas fa-dollar-sign"></i>
                <span class="snRegular"> Total</span>&nbsp;
                <span class="badge badge-success">R$ {{ valorTotal.toLocaleString('pt-BR', { minimumFractionDigits: 2 }) }}</span>
                <button @click="abrirModal('cadastrar')"
                    class="btn btn-primary float-right shadow">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div>

        <Modal :show="exibirModal">

            <input type="hidden" id="lista_id" v-model="form.lista_id">

            <div class="row mb-3">
                <div class="col-12">
                    <label class="form-label snRegular" for="nome">Produto</label>
                    <TextInput
                        id="nome"
                        ref="nomeInput"
                        type="text"
                        v-model="form.nome"
                        class="form-control"
                    />
                    <InputError :message="form.errors.nome" class="mt-2" />
                </div>
            </div>

            <div class="row">

                <div class="col-6">
                    <label class="form-label snRegular" for="quantidade">Quantidade</label>
                    <TextInput
                        id="quantidade"
                        ref="quantidadeInput"
                        type="number"
                        v-model="form.quantidade"
                        class="form-control"
                    />
                    <InputError :message="form.errors.quantidade" class="mt-2" />
                </div>
                <div class="col-6">
                    <label class="form-label snRegular" for="valor">Valor</label>
                    <TextInput
                        id="valor"
                        ref="valorInput"
                        type="number"
                        v-model="form.valor"
                        class="form-control"
                    />
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-6">
                    <button type="button" class="btn btn-danger snRegular" @click="closeModal"> Cancelar </button>
                </div>
                <div class="col-6 text-right">
                    <button @click="cadastrarOuEditarItem"
                        class="btn btn-success snRegular"
                        :class="{ 'disabled': form.processing }"
                        :disabled="form.processing"
                        >
                        {{ isEditing.value ? 'Editar Item' : 'Cadastrar Item' }}

                    </button>
                </div>
            </div>
        </Modal>

    </AuthenticatedLayout>
</template>
