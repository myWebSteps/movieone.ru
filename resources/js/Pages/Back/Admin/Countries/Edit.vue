<template>

    <Head title="Редактировать Страну" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Редактировать страну</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="updateCountry(country.id, country.title, country.slug)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Country Title</label>
                                <input v-model="country.title" type="text" class="d-block cform cform-custom-input" id="categoryTitle" placeholder="Название страны">
                            </div>
                            <div class="form-group">
                                <label for="genreSlug">Country Slug</label>
                                <input v-model="country.slug" type="text" class="d-block cform cform-custom-input" id="genreSlug" placeholder="Slug страны">
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

        <div v-if="errors" class="alert alert-warning alert-dismissible fade show position-fixed-bottom-end" role="alert">
            <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
            <div v-for="error in errors">
                <span>{{error}}</span>
            </div>
        </div>


    </AuthenticatedLayout>

</template>

<script>
    import {Head, router} from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

    export default {
        name: "Edit",
        props: ['country'],
        components: {Head, Link, AuthenticatedLayout},

        data(){
            return{
                errors: false,
            }
        },

        methods:{
            updateCountry(id, title, slug){
                router.patch(`/admin/countries/${id}`, {title: title, slug:slug})
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

