<template>
    <button class="btn btn-default" v-text="text" v-on:click="vote" v-bind:class="{'btn-success':voted}"></button>
</template>

<script>
    export default {
        props:['answer'],
        mounted() {
            axios.post('/api/answer/voted',{'answer':this.answer}).then(response => {
                this.voted = response.data.voted;
            })
        },
        data(){
            return{
                voted:false
            }
        },
        computed: {
            text(){
                return this.voted ? 'Voted' : 'Vote';
            }
        },
        methods:{
            vote(){
                axios.post('/api/answer/vote',{'answer':this.answer}).then(response => {
                    this.voted = response.data.voted;
                })
            }
        }
    }
</script>
