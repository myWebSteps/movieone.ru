<template>

    <Head title="Редактировать Категорию" />

        <h2 class="bg-white p-4 shadow-md">Редактировать категорию</h2>

        <section class="container mx-auto
        px-4 grid grid-flow-row grid-rows-[max-content]
         gap-4 py-4">

            <div class="grid grid-flow-row grid-rows-[50px_max-content_max-content] items-center w-fit">
                <div class="py-2">
                    <h3>Редактирование категории:</h3>
                </div>
                <form class="grid grid-flow-row w-fit bg-white px-4 py-2 gap-4 border-2 border-cyan-950"
                      @submit.prevent="updateCategory(category.id, category.title, category.slug, category.logo)"
                >
                    <div>
                        <label for="categoryTitle">Category Title:</label>
                        <input v-model="category.title"
                               type="text"
                               class="w-full"
                               id="categoryTitle"
                               placeholder="Название категории">
                    </div>
                    <div>
                        <label for="categorySlug">Category Title:</label>
                        <input v-model="category.slug"
                               type="text"
                               class="w-full"
                               id="categorySlug"
                               placeholder="Slug категории">
                    </div>
                    <div>
                        <label for="categoryLogo">CategoryLogo</label>
                        <input v-model="category.logo"
                               type="text"
                               class="w-full"
                               id="categoryLogo"
                               placeholder="Logo категории">
                    </div>
                    <div class="justify-self-end py-4 px-2">
                        <button type="submit"
                                class="py-1 px-6 border-2 border-red-700 rounded-2xl text-red-700 hover:bg-red-700 hover:text-white"
                        >Submit</button>
                    </div>

                </form>

            </div>

        </section>


        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-12">

                    <form >
                        <div class="card-body">



                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </section>

        <message :message.sync = "message"></message>

</template>

<script>
    import { Head } from "@inertiajs/vue3";
    import { Link } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {router} from '@inertiajs/vue3';
    import Message from "@/Components/Message.vue";

    export default {
        name: "Edit",
        layout: AuthenticatedLayout,
        props: ['category'],
        components: {Head, Link, router, Message},

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
            updateCategory(id, title, slug, logo){
                router.patch(`/admin/categories/${id}`, {title: title, slug: slug, logo: logo})
                router.on('error', (errors) => {
                    this.errors = errors.detail.errors
                })
            },
        },

    }
</script>

