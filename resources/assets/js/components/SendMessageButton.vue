<template>
    <div>
        <button class="btn btn-default" @click="showSendMessageModal">Send Message</button>
        <div class="modal fade" id="send-message-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        
                        <h4 class="modal-title">
                            Send message
                        </h4>
                    </div>

                    <div class="modal-body">
                        <textarea name="body" class="form-control" v-if="!status"cols="30" rows="10"
                        v-model="body"></textarea>
                        <div class="alert alert-success" v-if="status">
                            <strong>Success</strong>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-default" @click="send" >Send</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    

</template>

<script>
    export default {
        props:['to'],
        data(){
            return{
                status:false,
                body:'',
            }
        },
        methods:{
            showSendMessageModal(){
               
                this.status = false;
                $('#send-message-modal').modal('show');
            },
            send(){
                axios.post('/api/message',{'to':this.to,'body':this.body}).then(response => {
                    this.status = response.data.sent;
                    if(this.status)
                    {
                         this.body = "";
                        setTimeout(function(){
                            $('#send-message-modal').modal('hide');
                            
                        },2000);
                    }
                })
            }
        }
    }
</script>
