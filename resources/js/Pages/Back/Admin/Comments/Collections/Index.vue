<template>

    <Head title="Комментарии к коллекциям" />

    <h2 class="bg-white p-4 shadow-md">Список комментариев к коллекциям</h2>

    <section class="container mx-auto
        p-4 grid grid-flow-row grid-rows-[max-content_max-content]
        items-center
         gap-4">
            <div class="self-end">
                <h3>Список видео:</h3>
            </div>
            <div class="grid grid-flow-row gap-4 border-2 border-cyan-950 p-4 bg-white
            w-full
            md:w-fit
            ">
                <div class="grid gap-4
                    grid-flow-row
                    md:grid-cols-[max-content,_repeat(3,_60px),_repeat(2,_1fr),_minmax(100px,_150px)]
                    lg:grid-cols-[max-content,_repeat(3,_100px),_repeat(2,_1fr),_minmax(150px,_200px)]
                    ">
                    <div class="hidden md:block">Comment id</div>
                    <div class="hidden md:block">Collection name</div>
                    <div class="hidden md:block">Author name</div>
                    <div class="hidden md:block">Rating</div>
                    <div class="hidden md:block">Comment</div>
                    <div class="hidden md:block">Status</div>
                    <div class="justify-self-center hidden md:block">Action</div>

                    <template v-for="comment in data_comments">
                        <div><span class="md:hidden">Comment_id: </span>{{comment.comment_id}}</div>
                        <div><span class="md:hidden">Collection_name: </span>{{comment.collection_name}}</div>
                        <div><span class="md:hidden">Author_name: </span>{{comment.name}}</div>
                        <div><span class="md:hidden">Rating: </span>{{comment.rating}}</div>
                        <div><span class="md:hidden">Comment: </span>{{comment.description}}</div>
                        <div><span class="md:hidden">Status: </span>
                            <template v-if="comment.approved === 0">
                                <span class="text-red-500">На рассмотрении</span>
                            </template>
                            <template v-else>
                                <span class="text-green-500">Одобрено</span>
                            </template>
                        </div>

                       <div class="grid grid-flow-col justify-evenly justify-content-center content-center">
                            <Link as="button" :href="`/admin/comments/collections/${comment.comment_id}/edit`"
                                  class="py-1 px-6 border-2 border-amber-300 rounded-2xl text-amber-300 hover:bg-amber-300 hover:text-white
                            order-2
                            md:order-1
                            grid items-center
                            ">
                                <span class="material-symbols-sharp font-bold">edit_square</span>
                            </Link>
                            <Link @click.prevent="deleteInstance(comment.comment_id)" as="button"
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
        props: ['data_comments'],
        components: {Head, Link, AuthenticatedLayout},
        methods:{
            deleteInstance(id){
                router.delete(`/admin/comments/collections/${id}`, {
                    onBefore: () => confirm('Вы уверены, что хотите удалить этот комментарий?'),
                    onSuccess: () => this.$parent.getCommentsCount()
                })
            },
        },
    }
</script>



