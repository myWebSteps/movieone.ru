<template>

    <div v-for="movie in data" :class="config.classes" class="shadow-md bg-white rounded-sm overflow-hidden">
        <div>
            <Link :href="`/movies/${movie.slug}`" class="grid grid-flow-row">

                    <img v-lazy="movie.poster" :alt="movie.nameEn">

                <div class="p-2 grid grid-flow-row gap-1">
                    <h5 class="text-gray-900 text-wrap">{{movie.nameRu}}</h5>
                    <h5 class="text-gray-900 text-wrap">{{movie.nameEn}}</h5>
                    <p class="grid grid-flow-col auto-cols-max items-center">
                        <span class="material-symbols-sharp">camera_roll</span>
                            <span class="text-sm font-light" v-for="genre in movie.genres">
                                {{genre.title}}
                            </span>
                    </p>
                    <p class="grid grid-flow-col auto-cols-max items-center">
                        <span class="material-symbols-sharp">today</span>
                        <span class="text-red-800 font-light">{{movie.year}}</span>
                    </p>

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
