<template>

    <div class="grid shadow-md bg-white rounded-sm overflow-hidden" v-for="collection in data">
        <Link :href="`/collections/${collection.slug}`">
            <div class="grid grid-cols-[1fr,_2fr] gap-4">
                <div class="grid content-center">
                    <img v-lazy="collection.poster" class="my-4" alt="...">
                </div>

                    <div class="grid self-stretch">
                        <h5 class="text-gray-900">{{collection.collection_title}}</h5>
                        <p class="text-gray-900 text-sm">{{collection.description_min}}</p>
                        <p class="grid grid-flow-col auto-cols-max items-end">
                            <span class="material-symbols-sharp">today</span>
                            <span class="self-end text-red-800 font-light">{{collection.date}}</span>
                        </p>
                    </div>

            </div>
        </Link>

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
