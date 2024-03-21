<template>

    <Head>
        <title>MovieOne.ru | Случайные фильмы, мультики, аниме</title>
        <meta name="description" content="Случайные фильмы, мультики, аниме бесплатно и без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации случайный фильм мультик" />
    </Head>
       <!-- Content Header (Page header) -->
    <main class="container mx-auto mb-4
    grid grid-flow-row gap-4 z-20 bg-slate-100
    ">
        <div class="px-4 h-[70px] grid grid-flow-col justify-between bg-white content-center">
            <h1 class="text-gray-900">Случайные видео с сайта</h1>
            <Link :href="`/random_movies`" class="text-sm grid grid-flow-col auto-cols-max items-center">
                <span>Перемешать</span> &nbsp
                <span class="material-symbols-sharp">shuffle</span>
            </Link>
        </div>

        <template v-for="item in data">
            <div class="px-4 h-[50px] grid grid-flow-col justify-between content-center">
                <h2 class="text-gray-900">{{item.category}}</h2>
                <Link :href="`/movies?category=${item.slug}&order=year&page=1`" class="text-sm">
                    Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                </Link>
            </div>
            <div class="px-4 grid grid-cols-[repeat(auto-fit,_minmax(100px,_200px))] justify-items-center gap-4">
                <movies-card :data="item.movies" :config = "{classes: ''}"></movies-card>
            </div>
        </template>

    </main>

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
