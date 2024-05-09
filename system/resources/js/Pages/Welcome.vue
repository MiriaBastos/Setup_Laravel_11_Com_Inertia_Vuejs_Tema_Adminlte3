<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>

<template>
    <Head title="Bem vindo" />
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="m-auto">

                    <nav v-if="canLogin" class="text-center">
                        <Link
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class="Link"
                        >
                             Ir para o Dashboard
                        </Link>

                        <template v-else>
                            <div class="row">
                                <div class="col-sm-6">
                                    <Link
                                        :href="route('login')"
                                        class="btn btn-dark"
                                    >
                                        Fazer login
                                    </Link>
                                </div>
                                <div class="col-sm-6">
                                    <Link
                                        v-if="canRegister"
                                        :href="route('register')"
                                        class="btn btn-dark"
                                    >
                                        Fazer Cadastro
                                    </Link>
                                </div>
                            </div>
                        </template>
                    </nav>
                </div>

            </div>
        </div>

    </div>
</template>
