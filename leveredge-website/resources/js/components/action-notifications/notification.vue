<template>
    <div class="row">
        <div v-for="notification in actionNotifications" class="alert col-12" :class="getAdditionalClassFor(notification)">
            <i class="fa fa-3x" />
            <p v-text="notification.title" />
            <p v-html="notification.description" />
            <a v-if="notification.cta_text"
               :href="notification.cta_link"
               class="btn btn-primary"
               v-text="notification.cta_text" />
            <button v-if="notification.dismissable"
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    @click="dismissNotification(notification.id)"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</template>

<script scoped>
    export default {
        props: {
            actionNotifications: {
                type:    Array,
                default: () => [],
            },
        },

        methods: {
            getAdditionalClassFor(notification) {
                const additionalClasses = [];
                additionalClasses.push(`alert-${notification.notification_style}`);
                if (notification.dismissable) additionalClasses.push('alert-dismissible fade show');

                return additionalClasses;
            },

            dismissNotification(notificationId) {
                axios.post(`/member/dismiss-notification/${notificationId}`);
            },
        },
    };
</script>
