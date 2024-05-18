<template>

    <Head>
        <title>MovieOne.ru | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
        <meta name="description"
              content="MovieOne Онлайн кинотеатр с большим выбором фильмов, мультфильмов и аниме. У нас Вы всегда можете посмотреть любимые фильмы бесплатно и без регистрации"/>
        <meta name="keywords" content="Онлайн кинотеатр, смотреть фильмы онлайн, без регистрации"/>
    </Head>
    <!--cover-->
    <keep-alive>
    <cover-img
    class="max-h-[40vh]
    lg:max-h-[60vh]">
    </cover-img>
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

<script setup>
import{defineAsyncComponent} from "vue";

const CoverImg = defineAsyncComponent({
    loader: () => import('@/Components/CoverImg.vue'),
    loading: "loading"
})
</script>

<script>
import {Head, Link} from "@inertiajs/vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import CollectionsCard from "@/Components/CollectionsCard.vue";
import MoviesCard from "@/Components/MoviesCard.vue";

export default {
    name: "Home",
    layout: FrontLayout,
    props: ['data', 'collections'],
    components: {CollectionsCard, MoviesCard, Head, Link},

    mounted() {
        ym(94438576, 'hit', '/');

    },
}
</script>
