<template>

    <Head title="Создать Страну" />

    <h2 class="bg-white p-4 shadow-md">Создать страну</h2>

    <section class="container mx-auto
        px-4 grid grid-flow-row grid-rows-[max-content]
         gap-4 py-4">
            <div class="grid grid-flow-row grid-rows-[50px_max-content_max-content] items-center w-fit">
                <div class="py-2">
                    <h3>Добавление страны:</h3>
                </div>
                <form @submit.prevent="newCountry()" class="grid grid-flow-row w-fit bg-white px-4 py-2 gap-4 border-2 border-cyan-950">
                    <div>
                        <label for="categoryTitle">Country Title:</label>
                        <input v-model="form.title"
                               class="w-full"
                               type="text"
                               id="categoryTitle"
                               placeholder="Название страны">
                    </div>
                    <div>
                        <label for="categorySlug">Country Slug:</label>
                        <input v-model="form.slug"
                               type="text"
                               class="w-full"
                               id="categorySlug"
                               placeholder="Slug страны">
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
    import {Head, router} from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Message from "@/Components/Message.vue";

    export default {
        name: "Create",
        layout: AuthenticatedLayout,
        props: ['country'],
        components: {Head, Link, Message},

        data(){
            return{
                form:{
                    title: null,
                    slug: null,
                },
                message: {
                    body: [],
                    type: '',
                    show: false,
                },
            }
        },

        methods:{
            newCountry(){
                router.post('/admin/countries/store', this.form)
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>
