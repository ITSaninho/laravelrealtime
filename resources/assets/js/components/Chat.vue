<template>

    <div>
        <textarea class="form-control" rows="10" readonly="">{{messages.join('\n')}}</textarea>
        <hr>
        <input type="text" class="form-control" v-model="textMessage" v-on:keyup.enter="sendMessage" @keydown="actionUser">
        <span v-if="isActive">{{isActive.name}} набирає повідомлення</span>
    </div>

</template>

<script>
    export default {
        props: [
            'room',
            'user'
        ],
        data() {
            return {
                messages: [],
                textMessage: '',
                isActive: false,
                typingTimer: false
            }
        },
        computed: {
            channel() {
                return window.Echo.private('room.' + this.room.id)
            }
        },
        mounted() {
            this.channel.listen('PrivateChat', ({data}) => {
                this.messages.push(data.body)
                this.isActive = false;
            })
            .listenForWhisper('typing', (e) => {
                this.isActive = e;

                if(this.typingTimer) clearTimeout(this.typingTimer);

                this.typingTimer = setTimeout(() => {
                    this.isActive = false;
                }, 2000);
            });
        },
        methods: {
            sendMessage() {
                axios.post('/messages', { body: this.textMessage, room_id: this.room.id});
                this.messages.push(this.textMessage);
                this.textMessage = '';
            },

            actionUser() {
                this.channel.whisper('typing', {name: this.user.name});
            }
        }
    }
</script>
