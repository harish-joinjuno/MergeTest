<template>
    <div>
        <div
            v-if="show"
            class="action-notification d-flex flex-column flex-md-row justify-content-between m-1 m-md-0 mb-4 mb-md-3 p-3 p-md-4 pb-2 position-relative"
            :class="borderClass">

            <div class="d-flex flex-column flex-md-row mb-3 mb-md-0">
                <div
                    class="icon rounded-circle d-flex justify-content-center align-items-center mr-md-4 mb-3 mb-md-0 align-self-center"
                    :class="background">
                    <span v-if="icon === ''">!</span>
                    <i v-else class="fas" :class="icon" />
                </div>
                <div class="notification-text text-center text-md-left d-flex align-items-center" v-html="text" />
            </div>
            <div
                v-if="link !== ''"
                class="d-flex align-items-center justify-content-center mb-3 mb-md-0">
                <a
                    :href="link" class="btn pill-radius border-0 px-5 py-2"
                    :class="background">
                    <p class="my-1">
                        {{ linkText }}
                    </p>
                </a>
            </div>
            <i
                v-if="close"
                :class="color"
                class="fas fa-times position-absolute close"
                @click="dismissNotification" />
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            icon: {
                type:    String,
                default: '',
            },
            link: {
                type:    String,
                default: '',
            },
            linkText: {
                type:    String,
                default: '',
            },
            text: {
                type:     String,
                required: true,
            },
            close: {
                type:    Boolean,
                default: false,
            },
            notificationStyle: {
                type:    String,
                default: 'info',
            },
            notificationId: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                show:   true,
                colors: {
                    info:    'off-black',
                    success: 'secondary-green',
                    warning: 'yellow',
                    danger:  'dark-pink',
                    accent:  'pink',
                },
                btnClasses: {
                    warning: 'btn btn-warning',
                    success: 'btn btn-success',
                },
            };
        },
        computed: {
            background() {
                return `${this.btnClass} bg-${this.color}`;
            },

            borderClass() {
                return `border-${this.color}`;
            },

            color() {
                return this.colors[this.notificationStyle];
            },

            btnClass() {
                return this.btnClasses[this.notificationStyle] || 'btn-primary';
            },
        },
        methods: {
            dismissNotification() {
                axios.post(`/member/dismiss-notification/${this.notificationId}`)
                    .then(response => {
                        this.show = false;
                    })
            }
        },
    };
</script>
