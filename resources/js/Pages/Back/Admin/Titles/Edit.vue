<template>

    <Head title="Редактировать заголовок" />
        <h2 class="bg-white p-4">Редактировать заголовок</h2>


        <section class="container mx-auto
        px-4 grid grid-flow-row grid-rows-[max-content]
         gap-4 py-4">
            <div class="grid grid-flow-row grid-rows-[50px_max-content] w-full items-center">
                <div class="py-2">
                    <h3>Редактирование Seo заголовка:</h3>
                </div>
                <form @submit.prevent="updateSeoTitle()" class="grid grid-flow-row bg-white px-4 py-2 gap-4 border-2 border-cyan-950">
                    <div>
                        <label for="categoryTitle">Seo Title:</label>
                        <input v-model="form.description"
                               class="w-full"
                               type="text"
                               id="categoryTitle"
                               placeholder="Описание заголовка">
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
        props: ['title'],
        components: {Head, Link, router, Message},

        data(){
            return{
                form:{
                    id: this.title.id,
                    description: this.title.description,
                },
                message: {
                    body: [],
                    type: '',
                    show: false,
                }
            }
        },


        methods:{
            updateSeoTitle(){
                router.patch(`/admin/titles/${this.form.id}`, {description: this.form.description})
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>

