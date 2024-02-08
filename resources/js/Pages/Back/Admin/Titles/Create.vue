<template>

    <Head title="создать заголовок" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Создать заголовок</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                    <form @submit.prevent="newTitle()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Название фильма +</label>
                                <input v-model="form.description" type="text" class="d-block cform cform-custom-input w-100" id="categoryTitle" placeholder="тело заголовка">
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

    export default {
        name: "Create",
        components: {Head, Link, router, AuthenticatedLayout},

        data(){
            return{
                form:{
                    description: null,
                },
                message: {
                    body: [],
                    type: '',
                    show: false,
                }
            }
        },

        methods:{
            newTitle(){
                router.post('/admin/titles/store', this.form)
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>
