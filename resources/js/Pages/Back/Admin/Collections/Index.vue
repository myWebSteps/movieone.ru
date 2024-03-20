<template>

    <Head title="Коллекции" />

    <h2 class="bg-white p-4 shadow-md">Список коллекций</h2>


    <section class="container mx-auto
        p-4 grid grid-flow-row grid-rows-[minmax(50px,_max-content)_max-content_max-content]
        items-center
         gap-4">
            <div class="justify-self-start">
                <Link href="/admin/collections/create"
                      class="px-4 py-2  rounded-xl border-2 border-cyan-950 text-cyan-950 hover:bg-cyan-950 hover:text-white">
                    Добавить Коллекцию
                </Link>
            </div>
            <div class="self-end">
                <h3>Список коллекций:</h3>
            </div>
            <div class="grid grid-flow-row gap-4 border-2 border-cyan-950 p-4 bg-white
            w-full
            md:w-fit
            ">
                <div class="grid gap-4
                    grid-flow-row
                    md:grid-cols-[40px,_minmax(80px,_150px),_1fr,_120px,_minmax(100px,_150px)]
                    lg:grid-cols-[40px,_minmax(100px,_200px),_1fr,_170px,_minmax(150px,_200px)]
                    ">
                    <div class="hidden md:block">#</div>
                    <div class="hidden md:block">Title</div>
                    <div class="hidden md:block">Description</div>
                    <div class="hidden md:block">Status</div>
                    <div class="justify-self-center hidden md:block">Action</div>

                    <template v-for="collection in data">
                        <div><span class="md:hidden"># </span>{{collection.id}}</div>
                        <div><span class="md:hidden">Title: </span>{{collection.collection_title}}</div>
                        <div><span class="md:hidden">Description: </span>{{collection.description_min}}</div>
                        <div><span class="md:hidden">Status: </span>
                            <template v-if="Boolean(collection.is_published)">
                                <span class="text-green-500">Коллекция опубликована</span>
                            </template>
                            <template v-else>
                                <span class="text-red-500">черновик</span>
                            </template>
                        </div>

                        <div class="grid grid-flow-col justify-evenly justify-content-center content-center">
                            <Link as="button" :href="`/admin/collections/${collection.id}/edit`"
                                  class="py-1 px-6 border-2 border-amber-300 rounded-2xl text-amber-300 hover:bg-amber-300 hover:text-white
                            order-2
                            md:order-1
                            grid items-center
                            ">
                                <span class="material-symbols-sharp font-bold">edit_square</span>
                            </Link>
                            <Link @click.prevent="deleteInstance(collection.id)" v-if="$page.props.auth.user.role == 1" as="button"
                                  href="#"
                                  type="button"
                                  class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white
                            order-1
                            md:order-2
                            grid items-center
                            ">
                                <span class="material-symbols-sharp font-bold">delete</span>
                            </Link>
                        </div>
                    </template>
                </div>
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
                router.delete(`/admin/collections/${id}`, {
                    onBefore: () => confirm('Вы уверены, что хотите удалить эту коллекцию?'),
                })
            },
        },
    }
</script>
