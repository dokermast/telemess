<template>
    <div class="messenger">
        <Contacts :contacts="contacts" @selected="startChatWith"/>
        <Chat :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
    </div>
</template>

<script>
    import Chat from './Chat';
    import Contacts from './Contacts';
    export default {
        name: "Messenger",
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {

            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });

            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },
        methods: {
            startChatWith(contact){
                axios.get(`/chat/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    })
            },
            saveNewMessage(message) {
                this.messages.push(message);
            },
            hanleIncoming(message) {
                if (this.selectedContact && message.from == this.selectedContact.id) {
                    this.saveNewMessage(message);
                    return;
                }
            },
        },
        components: { Chat, Contacts }
    }
</script>

<style scoped>
    .messenger {
        display: flex;
    }
</style>
