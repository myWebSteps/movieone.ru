<template>

    <div v-if="message.show" :class="message.type === 'error' ? 'alert-warning' : 'alert-success'" class="alert  alert-dismissible fade show position-fixed-bottom-end my-z-index" role="alert">
        <button type="button" class="btn btn-close position-absolute-top-right" data-bs-dismiss="alert" aria-label="Close">X</button>
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
            console.log()
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
