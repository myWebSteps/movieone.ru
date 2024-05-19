<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description"
              content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
        <link rel="preload" :href="coverImg" as="image" type="image/webp">
    </Head>
    <!--cover-->
    <keep-alive>
    <cover-img :img="coverImg"></cover-img>
    </keep-alive>
    <!--Main Wrapper-->
    <section class="mb-4 z-20 bg-slate-100 relative">

        <div class="px-4 h-[70px] grid grid-flow-col justify-between content-center">
            <h1 class="text-gray-900 text-wrap">Подборки фильмов и мультиков</h1>
            <Link :href="`/collections`" class="text-sm
             hover:border-b-2 hover:border-[#1f2533]
             px-2
            ">
                <span class="hidden md:inline">Перейти ко всем &nbsp</span>
                <span class="icon-arrow_right_alt text-xl"></span>
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
                hover:border-b-2 hover:border-[#1f2533]
                px-2
                ">
                    <span class="hidden md:inline">Перейти ко всем &nbsp</span>
                    <span class="icon-arrow_right_alt text-xl"></span>
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
import {Head, Link} from "@inertiajs/vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import CollectionsCard from "@/Components/CollectionsCard.vue";
import MoviesCard from "@/Components/MoviesCard.vue";
import CoverImg from "@/Components/CoverImg.vue";

export default {
    name: "Home",
    layout: FrontLayout,
    props: ['data', 'collections'],
    components: {CoverImg, CollectionsCard, MoviesCard, Head, Link},

    data() {
        return {
            coverImg: null,
        }

    },
    beforeMount() {
        if(window.screen.width <= 430){
            this.coverImg = '/img/cover_min.webp'
        }else{
            this.coverImg = '/img/cover.webp'
        }
    },

    mounted() {
        ym(94438576, 'hit', '/');

    },
}
</script>
