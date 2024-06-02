<template>

    <img v-if="img != null" class="w-full object-contain row-start-1 row-end-1 col-start-1 col-end-1" :src="img"
         :alt="'Фоновая картинка ' + alt" width="1200" height="450">

</template>

<script>
export default {
    name: "BackdropImg",
    props: ['img', 'alt'],
}
</script>
