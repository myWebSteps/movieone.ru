<template>

    <Head>
        <title>MovieOne.ru | Подборки фильмов, мультфильмов, анимэ</title>
        <meta name="description" content="Подборки фильмов, мультфильмов, анимэ"/>
        <meta name="keywords" content="Подборки фильмов, мультфильмов, анимэ"/>
    </Head>

    <FrontLayout>
        <div class="container-fluid">
        <!-- Begin Page Content -->

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mt-4 mb-3">
                <h1 class="h5 mb-0 text-gray-900">Подборки фильмов и мультиков</h1>
            </div>
            <!-- Content Row -->
            <section class="row">
                        <div class="col-xl-4 col-md-6 mb-4" v-for="collection in form.collections.data">
                            <div class="card p-card shadow border-0">
                                <Link :href="`/collections/${collection.slug}`">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img v-lazy="collection.poster" class="card-img" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body h-100 d-grid">
                                                <h2 class="text-gray-900">{{collection.collection_title}}</h2>
                                                <p class="card-text">{{collection.description_min}}</p>
                                                <small><p class="mb-0 text-gray-900"><i class="fas fa-calendar-alt fa-sm fa-fw mr-1"></i> {{collection.date}}</p></small>
                                            </div>
                                        </div>
                                    </div>
                                </Link>
                            </div>
                        </div>

            </section>
            <!-- Pagination Row -->
            <section class="row d-flex justify-content-center">
                <nav v-if="form.collections.meta.last_page > 1" aria-label="Page navigation example">
                    <ul class="pagination">
                        <template v-if="data.meta.current_page != 1">
                            <li v-if="data.meta.current_page != 1" class="page-item">
                                <a @click.prevent="changePage(form.collections.meta.current_page - 1)" class="page-link" href="#"
                                   aria-label="Previous">
                                    <div aria-hidden="true">&laquo;</div>
                                </a>
                            </li>
                        </template>
                        <template v-for="link in form.collections.meta.links" >
                            <li v-if="Number(link.label) &&
                            (form.collections.meta.current_page - link.label < 3 &&
                            form.collections.meta.current_page - link.label > -3) ||
                            Number(link.label) === 1 || Number(link.label) === form.collections.meta.last_page
                            " class="page-item" :class="link.active? 'active' : ''">
                                <a @click.prevent="changePage(link.label)"
                                   class="page-link" href="#">{{link.label}}</a>
                            </li>
                            <li v-if="Number(link.label) &&
                            form.collections.meta.current_page != 4 &&
                            (form.collections.meta.current_page - link.label === 3) ||
                            Number(link.label) &&
                            form.collections.meta.current_page != form.collections.meta.last_page - 3 &&
                            (form.collections.meta.current_page - link.label === -3)">
                                <div class="page-link">...</div>
                            </li>
                        </template>
                        <template v-if="form.collections.meta.current_page != form.collections.meta.last_page">
                            <li v-if="form.collections.meta.current_page != form.collections.meta.last_page" class="page-item">
                                <a @click.prevent="changePage(form.collections.meta.current_page + 1)" class="page-link" href="#"
                                   aria-label="Next">
                                    <div aria-hidden="true">&raquo;</div>
                                </a>
                            </li>
                        </template>
                    </ul>
                </nav>
            </section>
            <!-- End Pagination Row -->

        </div>
    </FrontLayout>
</template>

<script>
    import {router, Head, Link} from "@inertiajs/vue3";
    import FrontLayout from "@/Layouts/FrontLayout.vue";


    export default {
        name: "Collections_catalog",
        props: ['data'],
        components: {Head, Link, FrontLayout},

        data() {
            return {
                form:{
                    page: this.data.meta.current_page,
                    collections: this.data,
                },
            }
        },

        mounted() {
            ym(94438576, 'hit', '/movies');

        },

        methods: {
            changePage(page) {
                this.form.page = page
                this.send();
            },

            send() {
                router.get('/collections',
                    {
                        page: this.form.page,
                    },
                    {preserveScroll: true});
            },

        }


    }
</script>


