<template>

    <Head title="Создать Страну" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="display-6">Создать страну</h2>
        </template>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form @submit.prevent="newCountry()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="countryTitle">Category Title</label>
                                <input v-model="form.title" type="text" class="form-control" id="countryTitle" placeholder="Название категории">
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
    import {Head, router} from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

    export default {
        name: "Create",
        props: ['country'],
        components: {Head, Link, AuthenticatedLayout},

        data(){
            return{
                form:{
                    title: null,
                },
            }
        },

        methods:{
            newCountry(){
                router.post('/admin/countries/store', this.form)
            },
        },

    }
</script>
