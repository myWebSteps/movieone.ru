<template>

    <div class="grid gap-2 grid-cols-[repeat(auto-fit,_minmax(10rem,_12rem))]
    px-2
    md:px-3
    "
    :class="$parent.$parent.show.menu ? 'justify-self-center sm:justify-self-stretch' : 'justify-self-stretch'"
    >

    <div v-for="movie in data" :class="config.classes" class="shadow-md bg-white rounded-sm overflow-hidden">

            <Link :href="`/movies/${movie.slug}`" class="h-full grid grid-rows-[max-content,_1fr] items-start">

                    <img v-lazy="movie.poster" :alt="movie.nameEn">

                <div class="p-2 grid gap-1 self-stretch max-w-[200px]">
                    <h3 class="text-gray-900 text-wrap">{{movie.nameRu}}</h3>
                    <h4 class="text-gray-900
                    overflow-hidden text-nowrap whitespace-nowrap text-ellipsis"
                    >
                        {{movie.nameEn}}</h4>
                    <h5>
                        <span class="material-symbols-sharp">camera_roll</span>
                            <span class="text-sm font-light text-wrap" v-for="genre in movie.genres">
                                <span>{{genre.title}}</span>&nbsp
                            </span>
                    </h5>
                    <h6 class="grid grid-flow-col auto-cols-max auto-rows-max self-end">
                        <span class="material-symbols-sharp">today</span>
                        <span class="self-end text-red-800 font-light">{{movie.year}}</span>
                    </h6>

                </div>

            </Link>
        </div>
    </div>

</template>

<script>
    import {Link} from "@inertiajs/vue3";

    export default {
        name: "MoviesCard",
        props: ['data', 'config'],

        components: {Link},
    }
</script>

<style scoped>

</style>
