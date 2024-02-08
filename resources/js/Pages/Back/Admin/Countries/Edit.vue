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

        <message :message.sync = "message"></message>


    </AuthenticatedLayout>

</template>

<script>
    import {Head, router} from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import Message from "@/Components/Message.vue";

    export default {
        name: "Edit",
        props: ['country'],
        components: {Head, Link, AuthenticatedLayout, Message},

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
            updateCountry(id, title, slug){
                router.patch(`/admin/countries/${id}`, {title: title, slug:slug})
                router.on('error', (errors) => {
                    this.message.body = errors.detail.errors
                    this.message.type = 'error'
                    this.message.show = true
                })
            },
        },

    }
</script>

