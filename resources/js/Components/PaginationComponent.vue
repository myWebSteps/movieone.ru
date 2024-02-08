<template>

    <section class="row d-flex justify-content-center">
        <nav v-if="data.meta.last_page > 1" aria-label="Page navigation example">
            <ul class="pagination">
                <template v-if="data.meta.current_page != 1">
                    <li v-if="data.meta.current_page != 1" class="page-item">
                        <a @click.prevent="changePage(data.meta.current_page - 1)" class="page-link" href="#"
                           aria-label="Previous">
                            <div aria-hidden="true">&laquo;</div>
                        </a>
                    </li>
                </template>
                <template v-for="link in data.meta.links" >
                    <li v-if="Number(link.label) &&
                            (data.meta.current_page - link.label < 3 &&
                            data.meta.current_page - link.label > -3) ||
                            Number(link.label) === 1 || Number(link.label) === data.meta.last_page
                            " class="page-item" :class="link.active? 'active' : ''">
                        <a @click.prevent="changePage(link.label)"
                           class="page-link" href="#">{{link.label}}</a>
                    </li>
                    <li v-if="Number(link.label) &&
                            data.meta.current_page != 4 &&
                            (data.current_page - link.label === 3) ||
                            Number(link.label) &&
                            data.meta.current_page != data.last_page - 3 &&
                            (data.current_page - link.label === -3)">
                        <div class="page-link">...</div>
                    </li>
                </template>
                <template v-if="data.meta.current_page != data.last_page">
                    <li v-if="data.meta.current_page != data.meta.last_page" class="page-item">
                        <a @click.prevent="changePage(data.meta.current_page + 1)" class="page-link" href="#"
                           aria-label="Next">
                            <div aria-hidden="true">&raquo;</div>
                        </a>
                    </li>
                </template>
            </ul>
        </nav>
    </section>

</template>

<script>
    export default {
        name: "PaginationComponent",
        props: ['data', 'form'],
        emits: ['interface'],

        methods:{

            send(){
                this.$emit('interface', this.form)
            },

            changePage(page) {
                this.form.page = page
                this.send();
            },
        },
    }
</script>

<style scoped>

</style>
