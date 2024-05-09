<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="register-page bgBody" cz-shortcut-listen="true" style="min-height: 542px;">
        <div class="register-box">
            <div class="card card-outline">
                <div class="card-header text-center">
                    <img src="../../../public/assets/images/logo.png" alt="Logo" width="16%" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light snRegular" style="font-size: 23px;">Despesas</span><b style="font-size: 20px;">App</b>
                </div>
                <div class="card-body">
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>
