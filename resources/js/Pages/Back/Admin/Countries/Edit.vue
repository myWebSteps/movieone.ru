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

                    <form @submit.prevent="updateCountry(country.id, country.title)">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="categoryTitle">Category Title</label>
                                <input v-model="country.title" type="text" class="form-control" id="categoryTitle" placeholder="Название категории">
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
            updateCountry(id, title){
                router.patch(`/admin/countries/${id}`, {title: title})
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

