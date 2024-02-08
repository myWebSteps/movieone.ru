<template>

    <Head title="создать категорию" />

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
                                <input v-model="form.title" type="text" class="d-block cform cform-custom-input" id="categoryTitle" placeholder="Название категории">
                            </div>
                            <div class="form-group">
                                <label for="categorySlug">Category Slug</label>
                                <input v-model="form.slug" type="text" class="d-block cform cform-custom-input" id="categorySlug" placeholder="Slug категории">
                            </div>
                            <div class="form-group">
                                <label for="categoryLogo">CategoryLogo</label>
                                <input v-model="form.logo" type="text" class="d-block cform cform-custom-input" id="categoryLogo" placeholder="Logo категории">
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
    import Message from '@/Components/Message.vue'

    export default {
        name: "Create",
        props: ['categories'],
        components: {Head, Link, router, AuthenticatedLayout, Message},

        data(){
            return{
                form:{
                    title: null,
                    slug: null,
                    logo: null,
                },
                message: {
                    body: [],
                    type: '',
                    show: false,
                }
            }
        },

        methods:{
            newCategory(){
                router.post('/admin/categories/store', this.form)
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

