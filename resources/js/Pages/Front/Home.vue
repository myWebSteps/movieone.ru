<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description"
              content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
    </Head>
    <!--cover-->
    <section class="grid items-top main-container
    lg:sticky
    lg:top-0
    h-fit
    max-h-[40vh]
    lg:max-h-[60vh]
    z-10 overflow-y-hidden"
    >
        <img class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" v-lazy="coverImg" alt="...">

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

    </section>

    <!--Main Wrapper-->
    <section class="mb-4 z-20 bg-slate-100 relative">

        <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
            <h1 class="text-gray-900 text-wrap">Подборки фильмов и мультиков</h1>
            <Link :href="`/collections`" class="text-sm
             hover:text-rose-500
            ">
                Перейти ко всем &nbsp
                <i class="icon-arrow_right_alt text-xl hover:text-rose-500"></i>
            </Link>
        </div>

        <div class="container mx-auto
    grid grid-flow-row gap-4
    ">
            <collections-card :data="collections"></collections-card>

        </div>


        <template v-for="item in data">

            <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
                <h2 class="text-gray-900">{{ item.category }}</h2>
                <Link :href="`/movies?category=${item.slug}&order=year&page=1`" class="text-sm
                hover:text-rose-500
                ">
                    Перейти ко всем &nbsp
                    <i class="icon-arrow_right_alt text-xl hover:text-rose-500"></i>
                </Link>
            </div>

            <div class="container mx-auto
            grid grid-flow-row gap-4
            ">
                <movies-card :data="item.movies" :config="{classes: ''}"></movies-card>
            </div>

        </template>


    </section>

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
            coverImg: null,
        }

    },
    beforeMount() {
        console.log(window.screen.width)
        if(window.screen.width <= 430){
            this.coverImg = '/img/cover_min.webp'
        }else{
            this.coverImg = '/img/cover.webp'
        }
    },

    beforeUnmount() {
        ym(94438576, 'hit', '/');
    },
}
</script>
