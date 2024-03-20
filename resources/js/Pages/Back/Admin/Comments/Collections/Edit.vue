<template xmlns="http://www.w3.org/1999/html">

    <Head title="Редактировать комментарий" />

    <h2 class="bg-white p-4 shadow-md">Редактирование комментария</h2>

    <section class="container mx-auto
        px-4 grid grid-flow-row grid-rows-[max-content]
         gap-4 py-4">
            <div class="grid grid-flow-row grid-rows-[50px_max-content_max-content] items-center">
                <div class="py-2">
                    <h3>Комментарий:</h3>
                </div>
                <div class="grid grid-flow-row bg-white px-4 py-2 gap-4 border-2 border-cyan-950">
                        <label>Имя автора: <br>
                        <input v-model="form.name"
                               type="text"
                               class="w-full"
                               placeholder="Имя автора">
                        </label>
                        <label>Описание: <br>
                        <textarea v-model="form.description"
                                  type="text" rows="5"
                                  class="w-full">
                        </textarea>
                        </label>
                    <div>
                        <span class="pr-2">Одобрить</span>
                        <input v-model="form.approved" type="checkbox" id="switch-1" checked />
                        <label for="switch-1"></label>
                    </div>

                    <div class="justify-self-end py-4 px-2">
                        <button type="submit" @click.prevent="updateComment()"
                                class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white"
                        >Submit</button>
                    </div>
                </div>
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
        props: ['comment'],
        components: {Head, Link, router, AuthenticatedLayout, Message},

        data(){
            return{
                message: {
                    body: [],
                    type: '',
                    show: false,
                },
                form: {
                    collection_id: this.comment.collection_id,
                    name: this.comment.name,
                    rating: this.comment.rating,
                    description: this.comment.description,
                    approved: this.comment.approved,
                }
            }
        },

        mounted(){
            if(this.form.approved == 1){
                this.form.approved = true
            }else if(this.form.approved == 0){
                this.form.approved = false
            };
        },


        methods:{

            updateComment(){
                 router.patch(`/admin/comments/collections/${this.comment.id}`, {
                    collection_id: this.form.collection_id,
                    name: this.form.name,
                    rating: this.form.rating,
                    description: this.form.description,
                    approved: this.form.approved,
                    } , {
                     onError: (errors) => {
                         this.message.body = errors.detail.errors
                         this.message.type = 'error'
                         this.message.show = true
                     },
                     onFinish: () => {
                         this.$parent.getCommentsCount()
                     },

                 })
            },
        },

    }
</script>

