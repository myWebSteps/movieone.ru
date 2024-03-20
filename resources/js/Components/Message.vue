<template>

    <div v-if="message.show" :class="message.type === 'error' ? 'bg-red-300' : 'bg-green-100'" class="px-8 py-6 fixed rounded-md bottom-3 right-2 z-40">
        <button @click="message.show = !message.show" type="button" class="absolute top-1 right-2 text-gray-600 hover:text-white">
            <span class="material-symbols-sharp">close</span></button>
        <div v-for="message in message.body">
            <span>{{message}}</span>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Message",
        props: ['message'],

        updated(){
            setTimeout(this.resetMessage, 2500)
        },

        methods:{
            resetMessage()
            {
                this.message.body = '';
                this.message.type = '';
                this.message.show = false;
            }
        }
    }
</script>

<style scoped>

</style>
