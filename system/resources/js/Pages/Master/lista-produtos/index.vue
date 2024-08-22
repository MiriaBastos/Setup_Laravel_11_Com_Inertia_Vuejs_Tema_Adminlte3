<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const { props } = usePage();

const nomeInput = ref(null);
const quantidadeInput = ref(null);
const valorInput = ref(null);

const exibirModal = ref(false);
const isEditing = ref(false);
const currentItem = ref(null);

// const itens = ref(props.listaCompras);

const form = useForm({
    nome: '',
    quantidade: '',
    valor: '',
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

const closeModal = () => {
    exibirModal.value = false;
    form.reset();
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

            <div class="">
                <ul class="todo-list ui-sortable" data-widget="todo-list">
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                            <label for="todoCheck1"></label>
                        </div>

                        <span class="text">Arroz sepe</span>

                        <small class="badge badge-info"> x2</small>
                        <small class="badge badge-success"> R$ 20,00</small>

                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                    <li>
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo2" id="todoCheck2">
                            <label for="todoCheck2"></label>
                        </div>

                        <span class="text">Feijão Com Brasil</span>

                        <small class="badge badge-info">x1</small>
                        <small class="badge badge-success"> R$ 100,99</small>

                        <div class="tools">
                            <i class="fas fa-edit"></i>
                            <i class="fas fa-trash-o"></i>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="card-footer clearfix">
                Quantidade de itens: <span class="badge badge-success">40</span> <br>
                Valor total: <span class="badge badge-success">R$ 400,00</span>
                <button @click="abrirModal('cadastrar')"
                    class="btn btn-primary float-right shadow">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div>

        <Modal :show="exibirModal">
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
