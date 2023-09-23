<script setup>
    import { Link } from "@inertiajs/vue3";
    import {defineComponent, reactive, watch, onMounted, computed, defineProps} from 'vue';

const form = reactive({
    categories: null
})

    onMounted(()=> {
        axios.get('/get_categories')
            .then(response => {
                console.log(response)
                form.categories = response.data

            })
        })


</script>

<template>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <Link :href="route('front.index')" class="brand-link">
            <img src="/img/logo-icon.png" alt="AdminLTE Logo" class="brand-image">
            <span class="brand-text font-weight-light">MovieOne</span>
        </Link>

        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden os-host-overflow os-host-overflow-y">

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">

                    <li v-for="category in form.categories" class="nav-item">
                        <Link  class="nav-link" :href="route('catalog.index', {category: category.id, order: 'year', page: 1})">
                            <i :class="category.logo"></i>
                            <p class="pl-2">{{category.title}}</p>
                        </Link>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

</template>

<!--<script>-->
<!--    export default {-->
<!--        name: "Sidebar",-->
<!--        data(){-->
<!--            return{-->
<!--                categories: null-->
<!--            }-->
<!--        },-->

        mounted() {
            this.getCategories()
        },
        methods: {


        },


    }
<!--</script>-->

<style scoped>

</style>
