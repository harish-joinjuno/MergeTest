<template>
    <div>
        <p class="description">
            <span>{{ this.description.substr(0, this.length) }}</span><!--

            --><span v-if="!this.description_expanded && this.description.length > this.length">...</span><!--

            --><span>
                <a
                    v-if="!this.description_expanded && this.description.length > this.length"
                    href="#"
                    @click.prevent="expandDescription()">show more</a>
            </span><!--

            --><span v-if="this.description_expanded && this.description.length > this.length">{{ this.description.substr(this.length,this.description.length) }}</span>
        </p>
    </div>
</template>

<script>
    export default{
        name: "ExpandableDescription",

        props: [
            'description',
            'length'
        ],

        data: function () {
            return {
                description_expanded : false
            }
        },

        methods:{
            expandDescription: function () {
                this.description_expanded = true
            }
        }

    }
</script>
