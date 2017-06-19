<template>
    <button class="btn btn-default" v-text="text" v-on:click="follow" v-bind:class="{'btn-success':followed}"></button>
</template>

<script>
    export default {
        props:['user'],
        mounted() {
            axios.post('/api/user/followed',{'user':this.user}).then(response => {
                this.followed = response.data.followed;
            })
        },
        data(){
            return{
                followed:false
            }
        },
        computed: {
            text(){
                return this.followed ? 'Followed' : 'Follow this user';
            }
        },
        methods:{
            follow(){
                 axios.post('/api/user/follow',{'user':this.user}).then(response => {
                this.followed = response.data.followed;
                })
            }
        }
    }
</script>
