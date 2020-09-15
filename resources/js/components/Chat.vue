<template>
    <div class="chat">
        <h2>{{ contact ? contact.name : 'Choose user'}}</h2>
        <Messages :contact="contact" :messages="messages"/>
        <MessageSource @send="sendMessage"/>
    </div>
</template>

<script>
    import Messages from './Messages';
    import MessageSource from './MessageSource';
    export default {
        name: "Chat",
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text) {
                if(!this.contact){
                    return;
                }
                axios.post('/chat/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                });
            }
        },
        components: {Messages, MessageSource},
    }
</script>

<style scoped>
    .chat {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    h1 {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
</style>
