<script setup>
    import { Link } from "@inertiajs/vue3";
    import ApplicationLogo from "@/Components/ApplicationLogo.vue";
    import NavLink from "@/Components/NavLink.vue";
    import Dropdown from "@/Components/Dropdown.vue";
    import DropdownLink from "@/Components/DropdownLink.vue";
    import Sidebar from "@/Components/Sidebar.vue";
    import Footer from "@/Components/Footer.vue";
    import Header from "@/Components/Header.vue";


</script>

<template>

    <div class="wrapper">

        <Sidebar ref="sidebar"></Sidebar>

        <Header ref="header"></Header>

        <div class="content-wrapper">

            <!-- Page Content -->
            <main>
                <slot />
            </main>

        </div>

        <Footer ref="footer"></Footer>
    </div>

</template>
