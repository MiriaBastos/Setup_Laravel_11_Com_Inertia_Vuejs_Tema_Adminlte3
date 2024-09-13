<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Logar" />

        <div v-if="status" class="alert alert-sm">
            {{ status }}
        </div>

        <form @submit.prevent="submit">

            <div class="row">
                <div class="input-group mb-3">

                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
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
                        autocomplete="current-password"
                    />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary snRegular">
                        <Checkbox name="remember"
                                 id="remember"
                                 v-model:checked="form.remember" />
                        <label for="remember">
                            Lembre-se
                        </label>
                    </div>
                </div>
                <PrimaryButton class="btn-block mt-2" >
                    Entrar
                </PrimaryButton>
            </div>

            <div class="row mt-2">
                <div class="col-sm-12">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="link snRegular"
                    >
                        Esqueceu sua senha?
                    </Link>
                </div>
            </div>

        </form>
    </GuestLayout>
</template>
