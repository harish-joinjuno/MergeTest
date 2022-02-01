<template>
    <div class="jumbotron bg-brand pt-0 pb-0">
        <div class="container text-light py-4">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div id="countdown-timer-wrap" class="float-md-right">
                        <table class="mx-auto mx-md-0">
                            <tr class="digits-row">
                                <td>
                                    <span v-if="showDay">{{ this.daysTo }}</span>
                                </td>
                                <td>
                                    <span class="colon">:</span>
                                </td>
                                <td>
                                    <span v-if="showHour">{{ this.hoursTo }}</span>
                                </td>
                                <td>
                                    <span class="colon">:</span>
                                </td>
                                <td><span v-if="showMinute">{{ this.minutesTo }}</span></td>
                                <td>
                                    <span class="colon">:</span>
                                </td>
                                <td>
                                    <span v-if="showSecond">{{ this.secondsTo }}</span>
                                </td>
                            </tr>

                            <tr class="label-row">
                                <td>
                                    Days
                                </td>
                                <td></td>
                                <td>
                                    Hours
                                </td>
                                <td></td>
                                <td>
                                    Minutes
                                </td>
                                <td></td>
                                <td>
                                    Seconds
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 my-md-auto text-center text-md-left mt-4 mt-md-0">
                    <slot name="message"></slot>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import dayjs from "dayjs"

    export default {
        name: "countdown-timer",
        props: ['showDay','showHour','showMinute','showSecond','countdownToString'],
        data() {
            return {
                now: dayjs(),
                countdownTo: dayjs(this.countdownToString),
                daysTo: 0,
                hoursTo: 0,
                minutesTo: 0,
                secondsTo: 0,
            }
        },
        timeout: NaN,
        created () {
            this.$options.timeout = setInterval ( () => {
                this.now = dayjs();
                this.daysTo = ("0" + Math.abs(this.countdownTo.diff(this.now,'day'))).slice(-2);
                this.hoursTo = ("0" + Math.abs(this.countdownTo.diff(this.now,'hour') % 24)).slice(-2);
                this.minutesTo = ("0" + Math.abs(this.countdownTo.diff(this.now, 'minute') % 60)).slice(-2);
                this.secondsTo = ("0" + Math.abs(this.countdownTo.diff(this.now, 'second') % 60)).slice(-2);
            }, 1000);
        },
        destroyed() {
            clearTimeout(this.$options.timeout)
        }
    }
</script>

<style scoped>
    #countdown-timer-wrap .digits-row span{
        font-size: 40px;
        color: white;
    }
    #countdown-timer-wrap .label-row td{
        font-size: 12px;
        color: white;
        text-align: center;
    }

    .colon{
        margin-right: 6px;
        margin-left: 6px;
    }

    .branded-link, .branded-link:hover{
        text-decoration: underline;
        color: white;
    }

</style>
