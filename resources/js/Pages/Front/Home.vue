<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description" content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации" />
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации" />
    </Head>

    <header class="grid items-center
    min-h-[200px]
    max-h-[40vh]
    bg-[url('/img/cover_min.webp')]
    bg-cover
    bg-no-repeat bg-center
    md:bg-[url('/img/cover.webp')]
    md:bg-fixed
    ">
        <div class="
        ml-[10%] opacity-50 font-extrabold z-10
        text-xl
        md:parallax
        md:absolute
        sm:text-2xl
        md:text-3xl">
            MovieOne.Ru <br>
            <span class="font-light">Онлайн-кинотеатр</span>
        </div>
    </header>

    <main class="container mx-auto mb-4 relative
    grid grid-flow-row gap-4 z-20 bg-slate-100
    ">
        <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
            <h1 class="text-gray-900">Подборки фильмов и мультиков</h1>
            <Link :href="`/collections`" class="text-sm">
                Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
            </Link>
        </div>
        <div class="px-4 grid grid-cols-[repeat(auto-fit,_minmax(150px,_300px))] justify-items-center gap-4">
            <collections-card :data="collections"></collections-card>
        </div>

        <template v-for="item in data">

            <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
            <h2 class="text-gray-900">{{item.category}}</h2>
                <Link :href="`/movies?category=${item.slug}&order=year&page=1`" class="text-sm">
                    Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                </Link>
            </div>
            <div class="
            px-4 grid justify-self-center justify-items-center gap-4
            sm:grid-cols-[repeat(auto-fit,_minmax(100px,_200px))]
            sm:justify-self-stretch
            "
            >

            <movies-card :data="item.movies" :config = "{classes: ''}"></movies-card>
            </div>
        </template>

    </main>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";
    import CollectionsCard from "@/Components/CollectionsCard.vue";
    import MoviesCard from "@/Components/MoviesCard.vue";


    export default {
        name: "Home",
        layout: FrontLayout,
        props: ['data', 'collections'],
        components: {CollectionsCard, MoviesCard, Head, Link},

        data(){
            return{
                slider:{
                    one: "",
                    two: "",
                    three: "",
                    four: "",
                    five: "",
                }
            }

        },

        beforeUnmount() {
            ym(94438576, 'hit', '/');
        },

    }
</script>
