<template>
    <div>
        <a  @click="followUser" class="pr-2 social-pointer"><span v-bind:class="classStatus" v-text="buttonText"></span></a>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'followsUrl', 'follows'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                status: this.follows
            }
        },
        methods: {
            followUser() {
                axios.post(this.followsUrl)
                    .then(response => {
                        this.status = !this.status;
                        console.log(response.data);
                    })
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });
            }
        },
        computed: {
            classStatus() {
                return (this.status) ? 'badge p-1 badge-danger' : 'badge p-1 badge-primary';
            },
            buttonText() {
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
