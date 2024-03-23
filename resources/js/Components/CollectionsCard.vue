<template>

    <div class="grid
        px-2
        md:px-3
        gap-2
        sm:justify-self-stretch
        sm:grid-cols-[repeat(auto-fit,_minmax(10rem,_18rem))]
        "
         :class="$parent.$parent.show.menu ? 'justify-self-center sm:justify-self-stretch' : 'justify-self-stretch'"
    >

    <div class="grid shadow-md bg-white rounded-sm overflow-hidden" v-for="collection in data">
        <Link :href="`/collections/${collection.slug}`">
            <div class="grid grid-cols-[2fr,_3fr] gap-4">
                <div class="grid content-center">
                    <img v-lazy="collection.poster" class="w-full" alt="...">
                </div>

                    <article class="grid self-stretch">
                        <h3 class="text-gray-900">{{collection.collection_title}}</h3>
                        <p class="text-gray-900 text-sm">{{collection.description_min}}</p>
                        <p class="grid grid-flow-col auto-cols-max items-end">
                            <span class="material-symbols-sharp">today</span>
                            <span class="self-end text-red-800 font-light text-wrap">{{collection.date}}</span>
                        </p>
                    </article>

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
