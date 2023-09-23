<template>

    <Head title="Создать страну" />

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

<script setup>
    import { Head } from "@inertiajs/vue3";
    import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
    import {defineComponent, reactive, watch, onMounted, computed, defineProps} from 'vue';
    import {router} from '@inertiajs/vue3';

    const form = reactive(
        {
            title: null,
        }
    );

    function newCountry(){
        router.post('/admin/countries/store', form)
    };

    // onMounted(()=>{});


</script>
