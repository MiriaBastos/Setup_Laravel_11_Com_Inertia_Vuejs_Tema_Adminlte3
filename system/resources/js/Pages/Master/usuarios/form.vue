<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

import { Link, useForm, usePage, Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <Head title="Editar" />

    <AuthenticatedLayout>

        <template #header>
            <h2 class="m-0">Editar Cadastro</h2>
        </template>

            <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="name" class="form-label snRegular">Nome</label>
                        <TextInput
                            id="name"
                            type="text"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="col-sm-6">
                        <label for="email" class="form-label snRegular">Email</label>
                        <TextInput
                            id="email"
                            type="email"
                            v-model="form.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div v-if="mustVerifyEmail && user.email_verified_at === null">
                            <p class="text-sm mt-2 text-gray-800">
                                Seu endereço de e-mail não foi verificado.
                                <Link
                                    :href="route('verification.send')"
                                    method="post"
                                    as="button"
                                    class="btn btn-primary"
                                >
                                    Clique aqui para reenviar o e-mail de verificação.
                                </Link>
                            </p>

                            <div
                                v-show="status === 'verification-link-sent'"
                                class="alert alert-info"
                            >

                                Um novo link de verificação foi enviado para seu endereço de e-mail.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div v-if="mustVerifyEmail && user.email_verified_at === null">
                            <p class="text-sm mt-2 text-gray-800">
                                Seu endereço de e-mail não foi verificado.
                                <Link
                                    :href="route('verification.send')"
                                    method="post"
                                    as="button"
                                    class="btn btn-primary snRegular"
                                >
                                    Clique aqui para reenviar o e-mail de verificação.
                                </Link>
                            </p>

                            <div
                                v-show="status === 'verification-link-sent'"
                                class="alert alert-info"
                            >

                                Um novo link de verificação foi enviado para seu endereço de e-mail.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-success snRegular">Editar Cadastro</button>
                    </div>
                </div>
            </form>
    </AuthenticatedLayout>
</template>
