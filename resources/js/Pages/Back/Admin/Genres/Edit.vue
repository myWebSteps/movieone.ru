<template>

    <Head title="Редактировать жанр" />

        <h2 class="bg-white p-4 shadow-md">Редактировать жанр</h2>


        <section class="container mx-auto
        px-4 grid grid-flow-row grid-rows-[max-content]
         gap-4 py-4">
            <div class="grid grid-flow-row grid-rows-[50px_max-content_max-content] items-center w-fit">
                <div class="py-2">
                    <h3>Добавление Жанра:</h3>
                </div>
                <form @submit.prevent="updateGenre()" class="grid grid-flow-row w-fit bg-white px-4 py-2 gap-4 border-2 border-cyan-950">
                    <div>
                        <label for="genreTitle">Genre Title</label>
                        <input v-model="form.title"
                               type="text"
                               class="w-full"
                               id="genreTitle"
                               placeholder="Название жанра">
                    </div>
                    <div>
                        <label for="genreSlug">Slug</label>
                        <input v-model="form.slug"
                               type="text"
                               class="w-full"
                               id="genreSlug"
                               placeholder="Slug жанра">
                    </div>
                    <div class="justify-self-end py-4 px-2">
                        <button type="submit"
                                class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white"
                        >Submit</button>
                    </div>
                </form>
            </div>

        </section>

        <message :message.sync = "message"></message>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {router} from '@inertiajs/vue3';
    import Message from "@/Components/Message.vue";

    export default {
        name: "Edit",
        layout: AuthenticatedLayout,
        props: ['genre'],
        components: {Head, Link, Message},

        data(){
            return {
                message: {
                    body: [],
                    type: '',
                    show: false,
                },
                form:{
                    id: this.genre.id,
                    category_id: this.genre.category_id,
                    slug: this.genre.slug,
                    title: this.genre.title
                },
            }
        },

        methods:{
            updateGenre(){
                router.patch(`/admin/genres/${this.form.id}`, this.form)
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>
