<template>

    <Head title="Видео"/>

    <h2 class="bg-white p-4 shadow-md">Список видео</h2>

        <section class="container mx-auto
        p-4 grid grid-flow-row grid-rows-[minmax(50px,_max-content)_max-content_max-content]
        items-center
         gap-4">
            <div class="justify-self-start">
                <Link href="/admin/movies/create"
                      class="px-4 py-2  rounded-xl border-2 border-cyan-950 text-cyan-950 hover:bg-cyan-950 hover:text-white">
                    Добавить Видео
                </Link>
            </div>
            <div class="self-end">
                <h3>Список видео:</h3>
            </div>
            <div class="grid grid-flow-row gap-4 border-2 border-cyan-950 p-4 bg-white
            w-full
            md:w-fit
            ">
                    <div class="grid gap-4
                    grid-flow-row
                    md:grid-cols-[40px,_repeat(2,_60px),_repeat(2,_1fr),_minmax(100px,_150px)]
                    lg:grid-cols-[40px,_repeat(2,_100px),_repeat(2,_1fr),_minmax(150px,_200px)]
                    ">
                        <div class="hidden md:block">#</div>
                        <div class="hidden md:block">Kinopoisk ID</div>
                        <div class="hidden md:block">year</div>
                        <div class="hidden md:block">nameRu</div>
                        <div class="hidden md:block">nameEn</div>
                        <div class="justify-self-center hidden md:block">Action</div>

                    <template v-for="movie in data">
                    <div><span class="md:hidden"># </span>{{ movie.id }}</div>
                    <div><span class="md:hidden">Kinopoisk ID: </span>{{ movie.kinopoisk_id }}</div>
                    <div><span class="md:hidden">year: </span>{{ movie.year }}</div>
                    <div><span class="md:hidden">nameRu: </span>{{ movie.nameRu }}</div>
                    <div><span class="md:hidden">nameEn: </span>{{ movie.nameEn }}</div>

                    <div class="grid grid-flow-col justify-evenly justify-content-center content-center">
                        <Link as="button" :href="`/admin/movies/${movie.id}/edit`"
                              class="py-1 px-6 border-2 border-amber-300 rounded-2xl text-amber-300 hover:bg-amber-300 hover:text-white
                            order-2
                            md:order-1
                            grid items-center
                            ">
                            <i class="icon-edit_square font-bold"></i>
                        </Link>
                        <Link @click.prevent="deleteInstance(movie.id)" v-if="$page.props.auth.user.role <= 9" as="button"
                              href="#"
                              type="button"
                              class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white
                            order-1
                            md:order-2
                            grid items-center
                            ">
                            <i class="icon-delete font-bold"></i>
                        </Link>
                    </div>
                </template>
                    </div>
            </div>



        </section>



</template>

<script>
import {Head, router} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    name: "Index",
    props: ['data'],
    layout: AuthenticatedLayout,
    components: {Head, Link, AuthenticatedLayout},
    methods:{
        deleteInstance(id){
            router.delete(`/admin/movies/${id}`, {
                onBefore: () => confirm('Вы уверены, что хотите удалить это видео?'),
            })
        },
    },
}
</script>
