<template>

    <Head title="Категории" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Создать категорию</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="newCategory()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Category Title</label>
                                <input v-model="form.title" type="text" class="form-control" id="categoryTitle" placeholder="Название категории">
                            </div>
                            <div class="form-group">
                                <label for="categoryLogo">CategoryLogo</label>
                                <input v-model="form.logo" type="text" class="form-control" id="categoryLogo" placeholder="Logo категории">
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



    </AuthenticatedLayout>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {router} from '@inertiajs/vue3';

    export default {
        name: "Create",
        props: ['categories'],
        components: {Head, Link, router, AuthenticatedLayout},

        data(){
            return{
                form:{
                    title: null,
                    logo: null,
                },
            }
        },

        methods:{
            newCategory(){
                router.post('/admin/categories/store', this.form)
            },
        },

    }
</script>
