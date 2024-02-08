<template>

    <Head title="Редактировать заголовок" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Редактировать заголовок</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                    <form @submit.prevent="updateCategory(title.id, title.description)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Title description</label>
                                <input v-model="title.description" type="text" class="d-block cform cform-custom-input w-100" id="categoryTitle" placeholder="Название заголовка">
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
        props: ['title'],
        components: {Head, Link, router, AuthenticatedLayout, Message},

        data(){
            return{
                message: {
                    body: [],
                    type: '',
                    show: false,
                }
            }
        },


        methods:{
            updateCategory(id, description){
                router.patch(`/admin/titles/${id}`, {description: description})
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>

