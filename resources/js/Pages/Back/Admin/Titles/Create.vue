<template>

    <Head title="создать заголовок" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Создать заголовок</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="newTitle()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Название фильма +</label>
                                <input v-model="form.description" type="text" class="form-control" id="categoryTitle" placeholder="тело заголовка">
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

        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-absolute bottom-0 end-0 z-10 position-fixed" role="alert">
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

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
                errors: false,
            }
        },

        methods:{
            newTitle(){
                router.post('/admin/titles/store', this.form)
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>
