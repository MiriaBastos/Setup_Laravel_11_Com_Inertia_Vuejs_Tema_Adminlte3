<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';


import { Link, useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingFormAdd = ref(true);
const nomeInput = ref(null);

const form = useForm({
    nome: '',
});


const confirmUserDeletion = () => {
    confirmingFormAdd.value = true;

    nextTick(() => nomeInput.value.focus());
};

// acao para adicionar um novo registro
const cadastraLista = () => {
    form.cadastra(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nomeInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingFormAdd.value = false;

    form.reset();
};

</script>

<template>

    <Head title="Listagem" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="m-0">Lista de compras</h2>
        </template>

        <div class="col-sm-12">
            <br>
            <table class="table" border="0">

                <tbody>
                    <tr class="bg-success">
                        <td style="border-radius: 20px; border: none;">
                            <i class="fa fa-list"></i>&nbsp;
                            <a href="#" class="link snRegular text-white">
                                <strong>LISTAGEM DO MÊS</strong>
                            </a>
                        </td>
                    </tr>
                    <br>
                    <tr class="bg-success">
                        <td style="border-radius: 20px; border: none;">
                            <i class="fa fa-list"></i>&nbsp;
                            <strong>LISTAGEM DA SEMANA</strong>
                        </td>
                    </tr>
                    <br>
                    <tr class="bg-success">
                        <td style="border-radius: 20px; border: none;">
                            <i class="fa fa-list"></i>&nbsp;
                            <strong>LISTAGEM DE ITENS EM GERAL</strong>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
        <br>
        <div class="col-sm-12">

            <Link @click="confirmUserDeletion"
                class="btn btn-info snRegular btn-block" style="border-radius: 20px;">
                CRIE UMA NOVA LISTAGEM
            </Link>

        </div>

        <Modal :show="confirmingFormAdd" @close="closeModal">

                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="card-title">Faça aqui uma nova listagem para suas compras</h3>
                    </div>
                    <br><br>

                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nome da lista</label>
                        <TextInput
                            id="name"
                            ref="nomeInput"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                            @keyup.enter="cadastraLista"
                        />

                        <InputError :message="form.errors.password" class="mt-2" />

                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <Link class="btn btn-default" @click="closeModal"> Cancelar </Link>
                    </div>
                    <div class="col-6 text-right">
                        <Link
                            class="ms-3 btn btn-success"
                            :class="{ 'd-none': form.processing }"
                            :disabled="form.processing"
                            @click="cadastraLista"
                            >
                            Criar Lista
                        </Link>
                    </div>
                </div>
        </Modal>

    </AuthenticatedLayout>
</template>
