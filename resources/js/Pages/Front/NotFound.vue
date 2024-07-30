<template>
    <Head>
        <title>404 | Смотреть интересные фильмы и мультики, анимэ онлайн бесплатно без регистрации</title>
    </Head>
    <section class="mb-4 z-20 bg-slate-100 relative">
        <div class="not-found">
            <h1>404</h1>
            <h2>Страница не найдена</h2>
            <a href="/"
              class="text-center border-2 border-rose-700 text-white bg-rose-700 px-2 py-1 mt-2 rounded-md shadow-md hover:text-rose-700 hover:bg-white">
              <div class="grid grid-flow-col items-center"><span class="font-light">На Главную</span></div>
            </a>
        </div>
    </section>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import FrontLayout from "@/Layouts/FrontLayout.vue";
import CollectionsCard from "@/Components/CollectionsCard.vue";
import MoviesCard from "@/Components/MoviesCard.vue";
import CoverImg from "@/Components/CoverImg.vue";

export default {
    name: "NotFound",
    layout: FrontLayout,
    props: ['data', 'collections'],
    components: {CoverImg, CollectionsCard, MoviesCard, Head, Link},
}
</script>

<style scoped>
  .not-found {
      text-align: center;
      margin-top: 50px;
  }
  .not-found h1 {
      font-size: 60px;
      font-weight: 700;
  }
  .not-found h2 {
      font-size: 20px;
  }
  .not-found a {
      display: inline-block;
  }
</style>
