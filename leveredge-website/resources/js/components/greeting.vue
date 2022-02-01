<template>
    <div class="greeting position-relative">
        <img class="w-100 d-md-block d-none" :src="`/img/dashboard/${text}-desktop.png`" alt="">
        <img class="w-100 d-md-none d-block" :src="`/img/dashboard/${text}-mobile.png`" alt="">
        <h2
            :class="color"
            class="off-black position-absolute m-2 pt-4 pt-md-5 pl-2 pl-md-5">
            Good {{ text }}, {{ name }}
        </h2>
    </div>
</template>

<script>
    export default {
        name:  'Greeting',
        props: {
            name: {
                type:    String,
                default: 'Guest',
            },
        },
        data() {
            return {
                text: 'morning',
            };
        },
        computed: {
            color() {
                return this.text === 'evening' ? 'white' : '';
            },
        },
        mounted() {
            const time = new Date().getHours();
            if (time >= '12' && time < '16') {
                this.text = 'afternoon';
            } else if (time >= '16' || time < '5') {
                this.text = 'evening';
            }
        },
    };
</script>
