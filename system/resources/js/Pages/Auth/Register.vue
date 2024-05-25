<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <form @submit.prevent="submit">
            <div class="row">
                <div class="input-group mb-3">
                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-user"></span>
                        </div>
                    </div>

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="input-group mb-3">
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-envelope"></span>
                        </div>
                    </div>

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="input-group mb-3">
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="input-group mb-3">
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>

                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <PrimaryButton class="btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Cadastrar
                </PrimaryButton>
                <Link
                    :href="route('login')"
                    class="mt-2"
                >
                    Eu já tenho uma assinatura
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
