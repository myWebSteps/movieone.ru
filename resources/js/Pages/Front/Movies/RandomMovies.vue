<template>

    <Head>
        <title>MovieOne.ru | Случайные фильмы, мультики, аниме</title>
        <meta name="description" content="Случайная подборка фильмов, мультиков, аниме и документальных видео" />
        <meta name="keywords" content="Случайная подборка фильмов, мультиков, аниме и документальных видео" />
    </Head>
       <!-- Content Header (Page header) -->

    <section class="px-4 h-[70px] grid grid-flow-col justify-between bg-white content-center">
        <h1 class="text-gray-900">Случайные видео с сайта</h1>
        <Link :href="`/random_movies`" class="text-sm grid grid-flow-col auto-cols-max items-center
        hover:border-b-2 hover:border-[#1f2533]
             px-2
        ">
            <span>Перемешать</span> &nbsp
            <i class="icon-shuffle text-xl"></i>
        </Link>
    </section>

    <section class="mb-4 z-20 bg-slate-100 relative">

        <template v-for="item in data">
            <div class="px-4 h-[50px] grid grid-flow-col justify-between content-center items-center">
                <h2 class="text-gray-900">{{item.category}}</h2>
                <Link :href="`/movies?category=${item.slug}&order=year&page=1`"
                class="text-sm
             hover:border-b-2 hover:border-[#1f2533]
             px-2">
                    <span class="hidden md:inline">Перейти ко всем &nbsp</span>
                    <span class="icon-arrow_right_alt text-xl"></span>
                </Link>
            </div>
            <div class="container mx-auto
                grid grid-flow-row gap-4
                    ">

                <movies-card :data="item.movies" :config = "{classes: ''}"></movies-card>
            </div>
        </template>

    </section>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import MoviesCard from "@/Components/MoviesCard.vue";


    export default {
        name: "Home",
        layout: FrontLayout,
        props: ['data'],
        components: {MoviesCard, Head, Link},

        mounted() {
            ym(94438576, 'hit', '/random_movies');
        },



    }
</script>
