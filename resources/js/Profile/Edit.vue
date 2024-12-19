<template>
    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center py-8 h-screen h-auto lg:py-0 px-4 py-12">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 md:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <alerts ref="alerts"></alerts>
                <div class="px-6 pt-8 pb-10 space-y-4 md:space-y-6 sm:px-8 sm:pt-8 sm:pb-12">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Edit profile
                    </h1>
                    <form @submit.prevent="updateProfile">
                        <div>
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                                <input
                                    type="text"
                                    v-model="name"
                                    name="name"
                                    id="name"
                                    placeholder="Your name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0"
                                    required
                                >
                            </div>
                        </div>
                        <div class="md:mt-6 mt-4">
                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail:</label>
                                <input
                                    type="email"
                                    v-model="email"
                                    name="email"
                                    id="email"
                                    placeholder="Your email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0"
                                    required
                                >
                            </div>
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-linear duration-500">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Alerts from '../Components/Alerts.vue';
import axios from 'axios';

export default {
    components: {
        'alerts': Alerts,
    },
    props: {
        user: Object,
    },
    data() {
        return {
            name: this.user?.name || '',
            email: this.user?.email || '',
        };
    },
    methods: {
        updateProfile() {
            axios.post('/profile/update', {
                name: this.name,
                email: this.email,
            })
            .then(response => {
                this.$refs.alerts.showAlert(response.data.message || 'Your profile updated successfully!', 'success');
            })
            .catch(error => {
                this.$refs.alerts.showAlert(error, 'error');
            });
        }
    }
};
</script>
