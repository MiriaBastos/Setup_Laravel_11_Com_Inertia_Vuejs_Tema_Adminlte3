<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="mb-3">
            Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail
            e enviaremos por e-mail um link de redefinição de senha que permitirá que
            você escolha uma nova
        </div>

        <div v-if="status" class="mb-3">
            {{ status }}
        </div>

        <form @submit.prevent="submit">

                <div class="input-group">
                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="row">
                    <div class="col-sm-12 mt-3">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Link de redefinição de senha de e-mail
                        </PrimaryButton>
                    </div>
                </div>
        </form>
    </GuestLayout>
</template>
