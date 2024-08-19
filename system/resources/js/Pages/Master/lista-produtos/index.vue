<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage, Link } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const { props } = usePage();

const currentProdutoNameInput = ref(null);
const currentProdutoQuantidadeInput = ref(null);
const currentProdutoValorInput = ref(null);

const form = useForm({
    nome: '',
    quantidade: '',
    valor: '',
});

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
        <!-- <form action="" method="post">
            <div class="row mb-3">

                <div class="col-12">
                    <label for="nome">Produto</label>
                    <TextInput id="nome" ref="currentProdutoNameInput" class="form-control-sm" v-model="form.nome"
                        type="text" autocomplete="new-nome" />
                </div>

            </div>

            <div class="row">

                <div class="col-5">
                    <label for="quantidade">Quantidade</label>
                    <TextInput id="quantidade" ref="currentProdutoQuantidadeInput" class="form-control-sm"
                        v-model="form.quantidade" type="number" autocomplete="new-quantidade" />
                </div>
                <div class="col-4">
                    <label for="valor">Valor</label>
                    <TextInput id="valor" ref="currentProdutoValorInput" class="form-control-sm" v-model="form.valor"
                        type="number" autocomplete="new-valor" />
                </div>
                <div class="col-3 mt-2">
                    <br>
                    <button type="submit" class="btn btn-success snRegular btn-sm">Cadastraar</button>
                </div>
            </div>
        </form> -->

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
                <button type="button" class="btn btn-primary float-right shadow"><i class="fas fa-plus"></i></button>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
