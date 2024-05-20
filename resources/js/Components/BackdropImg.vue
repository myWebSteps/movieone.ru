<template>

    <img v-if="img != null" class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" :src="img"
         alt="...">

</template>

<script>
export default {
    name: "BackdropImg",
    props: ['img'],
}
</script>
