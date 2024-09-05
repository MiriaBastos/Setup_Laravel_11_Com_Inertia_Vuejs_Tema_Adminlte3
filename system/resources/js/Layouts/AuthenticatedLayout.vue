<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="hold-transition layout-top-nav" cz-shortcut-listen="true" style="height: auto;">
        <div class="wrapper">

            <nav class="navbar navbar-expand-md navbar navbar-static-top navbar-light shadow">
                <div class="container-fluid">

                    <Link :href="route('dashboard')" class="navbar-brand">
                        <img
                        src="../../../public/assets/images/logo.png"
                        alt="Logo"
                        class="brand-image img-circle elevation-3"
                        width="18%"
                        style="opacity: .8">

                        <span class="brand-text font-weight-light">DespesasApp</span>
                    </Link>

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <Link
                                    :href="route('listagem.index')" :active="route().current('listagem.index')"
                                    class="nav-link">
                                    Lista de Produtos
                                </Link>
                            </li>
                            <!-- <li class="nav-item dropdown">
                                <a
                                    id="dropdownSubMenu1"
                                    href="#"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="nav-link dropdown-toggle">

                                    Despesas
                                </a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li>
                                        <a
                                            href="#"
                                            class="dropdown-item">
                                            <i class="fa fa-list-alt mr-1"></i>
                                            Lista de Despesas
                                        </a>
                                        <li class="dropdown-divider"></li>
                                        <Link
                                            :href="route('despesas.form')"
                                            class="dropdown-item">
                                            <i class="fa fa-check-circle mr-1"></i>
                                            Cadastrar despesa
                                        </Link>
                                        <li class="dropdown-divider"></li>

                                    </li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>

                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fa fa-cog"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <span class="dropdown-header">Configurações do Sistema</span>
                                <div class="dropdown-divider"></div>
                                <Link
                                    href="#"
                                    class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Cadastrar Renda
                                </Link>
                                <div class="dropdown-divider"></div>
                                <a
                                    href="#"
                                    class="dropdown-item">
                                    <i class="fas fa-envelope mr-2"></i>
                                    Cadastrar Categoria
                                </a>
                                <div class="dropdown-divider"></div>
                            </div>
                        </li> -->

                        <li class="nav-item dropdown show">
                            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                                <i class="fa fa-user-circle" style="font-size: 22px;"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

                                <div class="dropdown-item">
                                    <div class="media">
                                        <!-- <img src="../../../public/assets/images/user.png" alt="User Avatar" class="img-size-50 mr-3 img-circle elevation-2"> -->
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title">
                                                Olá, {{ $page.props.auth.user.name }}
                                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                            </h3>
                                            <div class="pt-2 pb-2">
                                                <Link :href="route('usuarios.form')" class="link text">Ver meu Perfil</Link>
                                            </div>
                                            <!-- :href="route('profile.edit')" -->
                                            <Link :href="route('logout')" method="post" class="link text-sm">
                                                <i class="fa fa-clock mr-1"></i>
                                                Sair
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2 snRegular">
                        <slot name="header" />
                    </div>
                </div>
            </div>

            <main class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- <footer class="card-footer">
            <div class="float-right d-none d-sm-inline">
                M.R
                </div>
                <strong>Copyright &copy; 2024 <a href="#">Miriã e Rafael</a>.</strong> All rights reserved.
            </footer> -->
        </div>
    </div>
</template>
