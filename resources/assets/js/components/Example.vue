<template>
    <button class="btn btn-default" v-text="text"></button>
</template>

<script>
    export default {
        mounted() {
            axios.post('/api/question/follower',{}).then(response => {
                console.log(response.data);
            })
        },
        data(){
            return{
                followed:false
            }
        },
        computed: {
            text(){
                return this.followed ? 'Followed' : 'Follow this question';
            }
        }
    }
</script>
