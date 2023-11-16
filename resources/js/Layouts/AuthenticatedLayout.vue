<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import NavLink from "@/Components/NavLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>

<template>
    <div class="bg-light min-vh-100">
        <!-- Primary Navigation Menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-admin-dark sticky-top">
            <div class="container-fluid">
                <!-- Logo -->
                <Link href="/" class="navbar-brand">
                    <ApplicationLogo class="text-danger" width="36" />
                </Link>

                <!-- Hamburger -->
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Navigation Links -->
                    <div class="navbar-nav">
                        <NavLink
                            href="/"
                            active="/"
                        >
                            Главная
                        </NavLink>
                    </div>         <div class="navbar-nav">
                    <NavLink
                        href="/admin/categories"
                        active="/admin/categories"
                    >
                        Категории
                    </NavLink>
                    <NavLink
                        href="/admin/genres"
                        active="/admin/genres"
                    >
                        Жанры
                    </NavLink>
                    <NavLink
                        href="/admin/countries"
                        active="/admin/countries"
                    >
                        Страны
                    </NavLink>
                    <NavLink
                        href="/admin/titles"
                        active="/admin/titles"
                    >
                        Заголовки
                    </NavLink>
                    <NavLink
                        href="/admin/movies"
                        active="/admin/movies"
                    >
                        Видео
                    </NavLink>
                    <NavLink
                        href="/admin/comments"
                        active="/admin/comments"
                    >
                        Комментарии
                    </NavLink>
                </div>


                    <!-- Settings Dropdown -->
                    <div class="navbar-nav ms-auto">
                        <Dropdown
                            :label="$page.props.auth.user.name"
                            as-nav-item
                        >
                            <DropdownLink href="/profile">
                                Profile
                            </DropdownLink>
                            <DropdownLink
                                href="logout"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </DropdownLink>
                        </Dropdown>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <header
            v-if="$slots.header"
            class="container-fluid bg-white shadow-sm px-lg-4 py-2"
        >
            <slot name="header" />
        </header>

        <!-- Page Content -->
        <main class="container-fluid py-4 p-lg-4">
            <slot />
        </main>
    </div>
</template>
