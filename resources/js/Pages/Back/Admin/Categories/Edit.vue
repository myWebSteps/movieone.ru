<template>

    <Head title="Редактировать Категорию" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Редактировать категорию</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="updateCategory(category.id, category.title, category.slug, category.logo)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Category Title</label>
                                <input v-model="category.title" type="text" class="form-control" id="categoryTitle" placeholder="Название категории">
                            </div>
                            <div class="form-group">
                                <label for="categorySlug">Category Title</label>
                                <input v-model="category.slug" type="text" class="form-control" id="categorySlug" placeholder="Slug категории">
                            </div>
                            <div class="form-group">
                                <label for="categoryLogo">CategoryLogo</label>
                                <input v-model="category.logo" type="text" class="form-control" id="categoryLogo" placeholder="Logo категории">
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
        name: "Edit",
        props: ['category'],
        components: {Head, Link, router, AuthenticatedLayout},

        data(){
            return{
                errors: false
            }
        },


        methods:{
            updateCategory(id, title, slug, logo){
                router.patch(`/admin/categories/${id}`, {title: title, slug: slug, logo: logo})
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

