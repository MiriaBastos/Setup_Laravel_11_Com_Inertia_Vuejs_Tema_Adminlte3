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

const itens = ref(props.produtoLista);
const dropDownSetor = ref(props.dropDownSetor);


const form = useForm({
    lista_id: props.lista.id,
    nome: '',
    quantidade: '',
    valor: '',
    setor_id: '',
});

const abrirModal = (resultado = null, item = null) => {

    if (resultado == 'editar') {
        isEditing.value = true;
        currentItem.value = item;
        form.nome = item.nome;
        form.quantidade = item.quantidade;
        form.valor = item.valor;
        form.setor_id = item.setor_id;
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
    }, 0); // Inicializa com 0 para evitar undefined
});

const totalItens = computed(() => {
    return itens.value.reduce((total, item) => total + item.quantidade, 0);
});

const itensMarcados = computed(() => {
    return itens.value.filter(item => item.checked);
});

const toggleCheck = (item) => {
    item.checked = !item.checked;
    Vue.set(item, 'checked', item.checked);
};

const truncarTexto = (texto, limite) => {
    if (texto.length > limite) {
        return texto.substring(0, limite) + '...';
    }
    return texto;
};

const excluirItensMarcados = () => {
    const idsParaExcluir = itensMarcados.value.map(item => item.id);

    if (idsParaExcluir.length === 0) {
        return;
    }

    const confirmacao = confirm(`Você tem certeza que deseja excluir ${idsParaExcluir.length} item(ns)?`);

    if (confirmacao) {
        // Envie a requisição de exclusão para o backend
        form.delete(route('lista-produto.excluir-marcados', { ids: idsParaExcluir }), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: (page) => {
                if (page.props.produtoLista) {
                    itens.value = page.props.produtoLista;
                }
            }
        });
    }
};

</script>

<template>

    <Head title="lista Itens" />

    <AuthenticatedLayout>
        <template #header>
            <div class="col-12">
                <h3 style="display: inline-block;">Lista de produtos</h3>
                <Link :href="route('listagem.index')" class="btn btn-dark btn-sm snRegular float-right mt-1">
                    VOLTAR
                </Link>
            </div>
        </template>

        <div class="card">
            <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title snRegular">
                    <i class="fa fa-clipboard mr-1"></i>
                    Lista de Compras do Mês
                </h3>
                <button v-if="itensMarcados.length" @click="excluirItensMarcados"
                    class="btn btn-danger btn-sm float-right ">
                    <i class="fas fa-trash"></i>
                </button>&nbsp;
            </div>

            <ul class="todo-list ui-sortable" data-widget="todo-list">
                <li v-for="item in itens" :key="item.id" :class="{ done: item.checked }">

                    <div class="icheck-primary d-inline">
                        <input type="checkbox" :checked="item.checked" @change="toggleCheck(item)" :id="`todoCheck${item.id}`">
                        <label :for="`todoCheck${item.id}`"></label>
                    </div>

                    <span class="text snRegular">{{ truncarTexto(item.nome, 18) }}</span>

                    <small class="badge badge-preto snRegular">x{{ item.quantidade }}</small>
                    <small class="badge badge-verde snRegular"> R$ {{ (item.valor * item.quantidade).toLocaleString('pt-BR', { minimumFractionDigits: 2 }) }}</small>

                    <div style="color: #3d3d3d; float: right; cursor: pointer;">
                        <i class="fas fa-edit" @click="abrirModal('editar', item)"></i>
                    </div>
                </li>
            </ul>

            <div class="card-footer clearfix">

                <i class="fa fa-cart-plus"></i> <span class="snRegular">Itens</span> <span class="badge badge-success snRegular">{{ totalItens }}</span>
                <i style="padding-left: 15px;" class="fas fa-dollar-sign"></i>
                <span class="snRegular"> Total</span>&nbsp;
                <span class="badge badge-success snRegular">
                    R$ {{ valorTotal ? valorTotal.toLocaleString('pt-BR', { minimumFractionDigits: 2 }) : '0,00' }}
                </span>
                <button @click="abrirModal('cadastrar')"
                    class="btn btn-dark float-right shadow">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div>

        <Modal :show="exibirModal" :title="isEditing ? 'Editar Produto' : 'Cadastrar Produto'" @close="closeModal">

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
                    <label class="form-label snRegular" for="nome">Setor</label>
                    <select class="form-control" name="setor_id" id="setor_id" v-model="form.setor_id">
                        <option value="" disabled>Selecione</option>
                        <option v-for="(nome, id) in dropDownSetor" :key="id" :value="id">{{ nome }}</option>
                    </select>
                    <InputError :message="form.errors.nome" class="mt-2" />
                </div>

                <div class="col-2">
                    <label class="form-label snRegular" for="quantidade">Qtd.</label>
                    <TextInput
                        id="quantidade"
                        ref="quantidadeInput"
                        type="number"
                        v-model="form.quantidade"
                        class="form-control"
                    />
                    <InputError :message="form.errors.quantidade" class="mt-2" />
                </div>
                <div class="col-4">
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
                        {{ isEditing ? 'Editar Item' : 'Cadastrar Item' }}

                    </button>
                </div>
            </div>
        </Modal>

    </AuthenticatedLayout>
</template>
