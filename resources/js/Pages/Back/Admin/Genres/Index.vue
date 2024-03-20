<template>

    <Head title="Жанры" />

        <h2 class="bg-white p-4 shadow-md">Список жанров</h2>

        <section class="container mx-auto
        px-4 grid grid-rows-[max-content] grid-cols-1
         gap-4 py-4">

            <div v-for="item in data" class="grid grid-flow-row grid-cols-1fr grid-rows-[50px_max-content_max-content] items-center
            w-full
            md:w-fit
">
                <div>
                    <h3>{{item.category_title}}</h3>
                </div>
                <div class=" text-wrap gap-2 grid border-2 border-cyan-950 px-4 py-2 bg-white text-gray-800 items-center

                md:grid-cols-[40px,_max-content_minmax(200px,_max-content)]
                ">
                    <div class="hidden md:block">#</div>
                    <div class="hidden md:block">Title</div>
                    <div class="justify-self-center">Action</div>
                    <template v-for="genre in item.genres">
                            <div><span class="md:hidden"># </span>{{genre.id}}</div>
                            <div><span class="md:hidden">Title </span>{{genre.title}}</div>
                            <div class="grid grid-flow-col justify-around justify-content-center">
                                <Link as="button" :href="`/admin/genres/${genre.id}/edit`"
                                      class="py-1 px-6 border-2 border-amber-300 rounded-2xl text-amber-300 hover:bg-amber-300 hover:text-white
                                grid items-center"
                                >
                                    <span class="material-symbols-sharp font-bold">edit_square</span>
                                </Link>
                                <Link @click.prevent="deleteInstance(genre.id)" v-if="$page.props.auth.user.role == 1" as="button"
                                      href="#"
                                      type="button"
                                      class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white
                                grid items-center"
                                >
                                    <span class="material-symbols-sharp font-bold">delete</span>
                                </Link>
                            </div>
                    </template>
                </div>
                <Link :href="`/admin/genres/${item.category_id}/create`"
                      class="px-4 py-1 mx-2 my-2 w-fit rounded-md border-2 border-cyan-950 text-cyan-950 hover:bg-cyan-950 hover:text-white"
                >Добавить жанр</Link>
            </div>
        </section>

</template>

<script>
import {Head, router} from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

    export default {
        name: "Index",
        layout: AuthenticatedLayout,
        props: ['data'],
        components: {Head, Link},
        methods:{
            deleteInstance(id){
                router.delete(`/admin/genres/${id}`, {
                    onBefore: () => confirm('Вы уверены, что хотите удалить этот жанр?'),
                })
            },
        },
    }
</script>
