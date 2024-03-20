<template>

    <ul v-if="data.meta.last_page > 1" class="justify-self-center w-fit rounded-sm overflow-x-hidden
                            grid grid-flow-col auto-cols-fr items-center
                            bg-gray-300">
                <template v-if="data.meta.current_page != 1">
                    <li v-if="data.meta.current_page != 1" class="py-2 px-4">
                        <a @click.prevent="changePage(data.meta.current_page - 1)" class="page-link" href="#">
                            <div>&laquo;</div>
                        </a>
                    </li>
                </template>
                <template v-for="link in data.meta.links" >
                    <li v-if="Number(link.label) &&
                            (data.meta.current_page - link.label < 3 &&
                            data.meta.current_page - link.label > -3) ||
                            Number(link.label) === 1 || Number(link.label) === data.meta.last_page"
                        class="py-2 px-4"
                        :class="link.active? 'bg-[#333454] text-white' : ''">
                        <a @click.prevent="changePage(link.label)"
                           class="page-link" href="#">{{link.label}}</a>
                    </li>
                    <li v-if="Number(link.label) &&
                            data.meta.current_page != 4 &&
                            (data.current_page - link.label === 3) ||
                            Number(link.label) &&
                            data.meta.current_page != data.last_page - 3 &&
                            (data.current_page - link.label === -3)"
                            class="py-2 px-4"
                            >
                        <div>...</div>
                    </li>
                </template>
                <template v-if="data.meta.current_page != data.last_page">
                    <li v-if="data.meta.current_page != data.meta.last_page" class="py-2 px-4">
                        <a @click.prevent="changePage(data.meta.current_page + 1)" class="page-link" href="#">
                            <div>&raquo;</div>
                        </a>
                    </li>
                </template>
            </ul>


</template>

<script>
    export default {
        name: "PaginationComponent",
        props: ['data', 'form'],
        emits: ['interface'],

        methods:{

            send(){
                this.$emit('interface', this.form.page)
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
