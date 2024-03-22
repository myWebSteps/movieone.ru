<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description"
              content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
    </Head>

    <header  class="grid items-top main-container
    lg:sticky
    lg:top-0
    h-fit
    max-h-[40vh]
    lg:max-h-[60vh]
    z-10 overflow-y-hidden"
    >
        <img  class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" src="/img/cover.webp" alt="...">

        <span class="row-start-1 row-end-1 col-start-1 col-end-1
        lg:parallax
        pt-[6%]
        pl-[10%]
        text-white opacity-60 font-extrabold
        text-xl
        sm:text-2xl
        md:text-3xl">
            MovieOne.Ru <br>
            <span class="font-light">Онлайн-кинотеатр</span>
        </span>

    </header>

    <main class=" container mx-auto mb-4 relative
    grid grid-flow-row gap-4 z-20 bg-slate-100
    ">
        <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
            <h1 class="text-gray-900">Подборки фильмов и мультиков</h1>
            <Link :href="`/collections`" class="text-sm">
                Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
            </Link>
        </div>
        <div class="px-4 grid
        gap-4
        sm:justify-self-stretch
        sm:grid-cols-[repeat(auto-fit,_minmax(150px,_300px))]
        "
             :class="$parent.show.menu ? 'justify-self-center justify-items-center' : 'grid-cols-[repeat(auto-fit,_minmax(150px,_250px))]'"
        >
            <collections-card :data="collections"></collections-card>
        </div>

        <template v-for="item in data">

            <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
                <h2 class="text-gray-900">{{ item.category }}</h2>
                <Link :href="`/movies?category=${item.slug}&order=year&page=1`" class="text-sm">
                    Перейти ко всем &nbsp<i class="fas fa-eye fa-sm"></i>
                </Link>
            </div>
            <div class="
            px-4 grid gap-4
            sm:grid-cols-[repeat(auto-fit,_minmax(100px,_200px))]
            sm:justify-self-stretch
            "
                 :class="$parent.show.menu ? 'justify-self-center justify-items-center' : 'grid-cols-2'"
            >

                <movies-card :data="item.movies" :config="{classes: ''}"></movies-card>
            </div>
        </template>

    </main>

</template>

<script>
import {Head} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import CollectionsCard from "@/Components/CollectionsCard.vue";
import MoviesCard from "@/Components/MoviesCard.vue";


export default {
    name: "Home",
    layout: FrontLayout,
    props: ['data', 'collections'],
    components: {CollectionsCard, MoviesCard, Head, Link},

    data() {
        return {
            slider: {
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
