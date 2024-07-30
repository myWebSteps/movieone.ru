<template>
        <Head>
            <title>Поиск фильмов MovieOne.ru</title>
            <meta name="description"
                  content="Поиск фильмов, мультиков, аниме и документальных видео"/>
            <meta name="keywords" content="Поиск фильмов, мультиков, аниме и документальных видео"/>
        </Head>
    <section class="px-4 h-[70px] grid grid-flow-col justify-items-start bg-white content-center">
        <h1 class="text-gray-900">Результаты запроса: {{ data.key }}</h1>
    </section>

        <section class="container mx-auto my-4
    grid grid-flow-row gap-4 z-20 bg-slate-100
    ">
          <movies-card  v-if="movies.length > 0" :data="movies" :config="{classes: 'col-xxl-2 col-xl-3 col-md-4 mb-4'}"></movies-card>

            <div v-else class="grid gap-2 mt-20 grid-flow-col grid-cols-[repeat(2,_max-content)] justify-self-center">
                <div><i class="icon-troubleshoot"></i></div>
                <div class="font-light">Не нашел фильмов по заданным критериям. Попробуйте облегчить мне задачу</div>
            </div>

        </section>


</template>


<script>
import {Head, Link} from "@inertiajs/vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import MoviesCard from "@/Components/MoviesCard.vue";


export default {
    name: "Catalog",
    layout: FrontLayout,
    props: ['movies', 'data'],
    components: {Head, Link, MoviesCard},
    mounted() {
        this.$parent.searchKey = ''
        ym(94438576, 'hit', '/search');
    },

}
</script>



