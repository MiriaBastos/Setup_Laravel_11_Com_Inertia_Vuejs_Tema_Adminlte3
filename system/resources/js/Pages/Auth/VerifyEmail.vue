<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />

        <div class="mb-3 text-sm">
            Obrigado por se inscrever! Antes de começar, você poderia verificar seu endereço de e-mail clicando no link
            acabamos de enviar um e-mail para você? Se você não recebeu o e-mail, teremos prazer em lhe enviar outro.
        </div>

        <div class="mb-3 text-sm" v-if="verificationLinkSent">
            Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu durante o registro.
        </div>

        <form @submit.prevent="submit">
            <div class="row">
                <div class="col-sm-12">
                    <PrimaryButton class="btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Reenviar email de verificação
                    </PrimaryButton>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class=""
                        >Sair</Link
                    >
                </div>
            </div>
        </form>
    </GuestLayout>
</template>
