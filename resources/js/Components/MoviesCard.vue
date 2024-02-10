<template>

    <div v-for="movie in data" :class="config.classes">
        <div class="card m-card shadow border-0">
            <Link :href="`/movies/${movie.slug}`">
                <div class="m-card-cover phone-cover">
                    <img v-lazy="movie.poster" class="card-img-top" :alt="movie.nameEn">
                </div>

                <div class="card-body">
                    <h5 class="card-title text-gray-900 mb-1 text-wrap">{{movie.nameRu}}</h5>
                    <h5 class="card-title text-gray-900 mb-1 text-wrap">{{movie.nameEn}}</h5>
                    <p class="card-text mb-1">
                        <small class="text-muted"><i class="fa-solid fa-tape mr-2"></i>
                            <span v-for="genre in movie.genres" class="text-muted phone_text_size">
                                                    {{genre.title}} &nbsp
                            </span>
                        </small>
                    </p>
                    <p class="card-text text-danger">
                        <small>
                            <span class="phone_text_size"><i class="fas fa-calendar-alt fa-sm text-gray-400"></i> {{movie.year}}</span>
                        </small>
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
