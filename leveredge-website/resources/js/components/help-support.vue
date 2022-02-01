<template>
    <div class="dashboard-row">
        <div class="head p-3 p-md-4">
            <h2 class="h4 off-black mb-0 mx-md-2">
                Help & support
            </h2>
            <hr class="mt-2 mt-md-3 mb-0 mb-md-2 mx-md-2">
        </div>
        <div class="content text-center p-3 p-md-5">
            <h2 class="off-black mt-2 mt-md-0">
                {{ title }}
            </h2>
            <div class="desc py-2 mb-4">
                <span>{{ description }}</span>
            </div>
            <div class="d-flex justify-content-center">
                <div v-if="sent" class="w-100">
                    <div class="d-flex justify-content-center">
                        <div class="rounded-circle sent-image">
                            <img src="/img/spring-season-with-check.png" alt="">
                        </div>
                    </div>
                    <button class="btn bg-primary-off-white secondary-green mt-5 rounded-pill w-100 py-2" @click="send">
                        <span class="my-1">Message sent!</span>
                    </button>
                </div>
                <div v-else class="textarea-form w-100">
                    <textarea
                        v-model="message"
                        name=""
                        cols="30"
                        rows="4"
                        class="pb-2 w-100 p-2"
                        placeholder="We understand that student loans and our negotiation process can be complicated. Please ask us any and all questions you have!" />
                    <div class="textare-line" />
                    <div class="button-content py-4 px-3">
                        <button class="btn bg-secondary-green white rounded-pill w-100 py-2 px-5" @click="send">
                            <span class="my-1">Send</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'HelpSupport',
        data() {
            return {
                message: null,
                sent:    false,
            };
        },
        computed: {
            title() {
                return this.sent ? 'Thanks for reaching out!' : 'Got questions?';
            },
            description() {
                return this.sent ? 'On average we respond back in less than 24 working hours.'
                    : 'Ask Nikhil, Co-founder & helpful human, anything!';
            },
        },
        methods: {
            send() {
                axios.post('/helpscout/send-message', {message: this.message})
                    .then((response) => {
                        this.sent = true;
                    });
            },
        },
    };
</script>
