<template>

    <div v-if="data.parser"
         @click="data.parser = !data.parser"
         class="z-10 fixed top-0 bottom-0 left-0 right-0"
    >
    </div>

</template>

<script>
export default {
    name: "Wrapper",
    props: ['data'],

}
</script>

<style scoped>

</style>
