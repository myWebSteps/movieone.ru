<template>

    <Head title="создать категорию" />

        <h2 class="bg-white p-4 shadow-md">Создать категорию</h2>

        <section class="h-full
        px-4 grid grid-flow-row grid-rows-[max-content]
         gap-4 py-4">
            <div class="grid grid-flow-row grid-rows-[50px_max-content_max-content] items-center w-fit">
                <div class="py-2">
                    <h3>Добавление категории:</h3>
                </div>
                <form @submit.prevent="newCategory()" class="grid grid-flow-row w-fit bg-white px-4 py-2 gap-4 border-2 border-cyan-950">
                    <div>
                        <label for="categoryTitle">Category Title:</label>
                        <input v-model="form.title"
                               class="w-full"
                               type="text"
                               id="categoryTitle"
                               placeholder="Название категории">
                    </div>
                    <div>
                        <label for="categorySlug">Category Slug:</label>
                        <input v-model="form.slug"
                               type="text"
                               class="w-full"
                               id="categorySlug"
                               placeholder="Slug категории">
                    </div>
                    <div>
                        <label for="categoryLogo">Category Logo:</label>
                        <input v-model="form.logo"
                               type="text"
                               class="w-full"
                               id="categoryLogo"
                               placeholder="Logo категории">
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
    import Message from '@/Components/Message.vue'

    export default {
        name: "Create",
        layout: AuthenticatedLayout,
        props: ['categories'],
        components: {Head, Link, router, Message},

        data(){
            return{
                form:{
                    title: null,
                    slug: null,
                    logo: null,
                },
                message: {
                    body: [],
                    type: '',
                    show: false,
                }
            }
        },

        methods:{
            newCategory(){
                router.post('/admin/categories/store', this.form)
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

