<template>

    <Head title="Редактировать комментарий" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Редактировать комментарий</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                    <form @submit.prevent="updateComment()">
                        <div class="card-body">
                            <div class="col-6 col-xs-12 mb-3">
                                <label for="authorName">Имя:</label>
                                <input v-model="form.name" type="text" class="d-block cform cform-custom-input w-100" id="authorName" placeholder="Имя автора">
                            </div>

                            <div class="col-12 mb-3">
                                <label for="commentDescription">Описание</label>
                                <textarea v-model="form.description" type="text" rows="10" class="d-block cform cform-custom-input w-100" id="commentDescription">
                                </textarea>
                            </div>

                            <div class="cform-switch cform-switch-big cform-custom-switch mb-3">
                                <span class="pr-2">Одобрить</span>
                                <input v-model="form.approved" type="checkbox" id="switch-1" checked />
                                <label for="switch-1"></label>

                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </section>

        <message :message.sync = "message"></message>

    </AuthenticatedLayout>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {router} from '@inertiajs/vue3';
    import Message from "@/Components/Message.vue";

    export default {
        name: "Edit",
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
                    })
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>

