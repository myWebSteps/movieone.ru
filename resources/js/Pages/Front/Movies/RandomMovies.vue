<template>

    <Head>
        <title>MovieOne.ru | Случайные фильмы, мультики, аниме</title>
        <meta name="description" content="Случайные фильмы, мультики, аниме бесплатно и без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации случайный фильм мультик" />
    </Head>
       <!-- Content Header (Page header) -->

    <section class="px-4 h-[70px] grid grid-flow-col justify-between bg-white content-center">
        <h1 class="text-gray-900">Случайные видео с сайта</h1>
        <Link :href="`/random_movies`" class="text-sm grid grid-flow-col auto-cols-max items-center
        hover:text-rose-500
        ">
            <span>Перемешать</span> &nbsp
            <span class="material-symbols-sharp hover:text-rose-500">shuffle</span>
        </Link>
    </section>

    <section class="container mx-auto mb-4
    grid grid-flow-row gap-4 z-20 bg-slate-100
    ">

        <template v-for="item in data">
            <div class="px-4 h-[50px] grid grid-flow-col justify-between content-center items-center">
                <h2 class="text-gray-900">{{item.category}}</h2>
                <Link :href="`/movies?category=${item.slug}&order=year&page=1`"
                      class="text-sm p-1
                       hover:text-rose-500
                       "
                >
                    Перейти ко всем &nbsp
                    <span class="material-symbols-sharp">arrow_right_alt</span>
                </Link>
            </div>

                <movies-card :data="item.movies" :config = "{classes: ''}"></movies-card>

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

        beforeUnmount() {
            ym(94438576, 'hit', '/random_movies');
        },



    }
</script>
