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

<script setup>
    import { Head } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {defineComponent, reactive, watch, onMounted, computed, defineProps} from 'vue';
    import {router} from '@inertiajs/vue3';

    const form = reactive(
        {
            title: null,
            logo: null,
        }
    );

    function newCategory(){
        router.post('/admin/categories/store', form)
    };

    // onMounted(()=>{});


</script>
