<template>

    <Head>
        <title>MovieOne.ru | Подборки фильмов, мультфильмов, анимэ</title>
        <meta name="description" content="Подборки фильмов, мультфильмов, анимэ"/>
        <meta name="keywords" content="Подборки фильмов, мультфильмов, анимэ"/>
    </Head>

    <FrontLayout>
        <div class="container-fluid">
        <!-- Begin Page Content -->

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3">
                <h1 class="h5 mb-0 text-gray-900">Подборки фильмов и мультиков</h1>
            </div>
            <!-- Content Row -->
            <section class="row">

                <collections-card :data="form.collections.data"></collections-card>

            </section>

            <!-- Pagination Row -->
            <pagination-component :data="form.collections" :form="form" @interface="send()"></pagination-component>
            <!-- End Pagination Row -->

        </div>
    </FrontLayout>
</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import CollectionsCard from "@/Components/CollectionsCard.vue";
    import PaginationComponent from "@/Components/PaginationComponent.vue";

    export default {
        name: "Collections_catalog",
        props: ['data'],
        components: {CollectionsCard, Head, Link, FrontLayout, PaginationComponent},

        data() {
            return {
                form:{
                    page: this.data.meta.current_page,
                    collections: this.data,
                },
            }
        },

        mounted() {
            ym(94438576, 'hit', '/collections');

        },

        methods: {
             send() {
                router.get('/collections',
                    {
                        page: this.form.page,
                    },
                    {preserveScroll: true});
            },

        }


    }
</script>


