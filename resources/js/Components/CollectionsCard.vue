<template>
    <div class="col-xxl-3 col-xl-4 col-md-6 mb-4" v-for="collection in data">
        <div class="card p-card shadow border-0">
            <Link :href="`/collections/${collection.slug}`">
                <div class="row no-gutters">
                    <div class="col-4 d-grid align-content-center">
                        <img v-lazy="collection.poster" class="card-img" alt="...">
                    </div>
                    <div class="col-8">
                        <div class="card-body h-100 d-grid">
                            <h5 class="text-gray-900">{{collection.collection_title}}</h5>
                            <p class="card-text text-gray-900">{{collection.description_min}}</p>
                            <small><p class="mb-0 text-gray-900"><i class="fas fa-calendar-alt fa-sm fa-fw mr-1"></i> {{collection.date}}</p></small>
                        </div>
                    </div>
                </div>
            </Link>
        </div>
    </div>
</template>

<script>
    import { Link } from "@inertiajs/vue3";

    export default {
        name: "CollectionsCard",
        props: ['data'],

        components: {Link}
    }
</script>

<style scoped>

</style>
