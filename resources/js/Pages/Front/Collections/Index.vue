<template>

    <Head>
        <title>MovieOne.ru | Подборки фильмов, мультфильмов, анимэ</title>
        <meta name="description" content="Подборки фильмов, мультфильмов, анимэ и документальных видео"/>
        <meta name="keywords" content="Подборки фильмов, мультфильмов, анимэ и документальных видео"/>
    </Head>

    <!-- Page Heading -->
    <section class="px-4 mb-4 h-[70px] grid bg-white content-center justify-start"
    >
        <h1 class="justify-self-start text-gray-900">Подборки фильмов и мультиков</h1>
    </section>

    <!-- Begin Page Content -->
    <section class="grid px-2">

            <collections-card :data="form.collections.data"></collections-card>


        <!-- Pagination Row -->
        <pagination-component
            class="self-center"
            :data="form.collections"
            :form="form"
            @interface="send()">
        </pagination-component>

        <!-- End Pagination Row -->

    </section>

</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import CollectionsCard from "@/Components/CollectionsCard.vue";
    import PaginationComponent from "@/Components/PaginationComponent.vue";
    import MoviesCard from "@/Components/MoviesCard.vue";

    export default {
        name: "Collections_catalog",
        layout: FrontLayout,
        props: ['data'],
        components: {MoviesCard, CollectionsCard, Head, Link, PaginationComponent},

        data() {
            return {
                form:{
                    page: this.data.meta.current_page,
                    collections: this.data,
                },
            }
        },

        beforeUnmount() {
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


