<template>

    <Head>
        <title>MovieOne.ru | Подборки фильмов, мультфильмов, анимэ</title>
        <meta name="description" content="Подборки фильмов, мультфильмов, анимэ"/>
        <meta name="keywords" content="Подборки фильмов, мультфильмов, анимэ"/>
    </Head>

    <section class="grid grid-rows-[70px,_calc(100%-140px),_70px] px-2 h-full">
        <!-- Begin Page Content -->
        <!-- Page Heading -->
        <div class="grid grid-flow-col content-center">
            <h1 class="justify-self-start text-gray-900">Подборки фильмов и мультиков</h1>
        </div>

        <div class="grid grid-cols-[repeat(auto-fit,_minmax(100px,_200px))] auto-rows-max justify-items-center gap-4">
            <collections-card :data="form.collections.data"></collections-card>
        </div>

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


