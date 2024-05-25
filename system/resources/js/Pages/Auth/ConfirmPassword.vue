<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-3 text-sm">
            Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.
        </div>

        <form @submit.prevent="submit">
            <div class="row">
                <div class="input-group mb-3">
                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        autofocus
                    />

                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>

                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-3">
                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Confirmar
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
