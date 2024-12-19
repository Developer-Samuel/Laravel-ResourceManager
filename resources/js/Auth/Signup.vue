<template>
    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center py-8 min-h-screen h-auto lg:py-0 px-4 py-12">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 md:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <alerts ref="alerts"></alerts>
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Create an account
                    </h1>
                    <form @submit.prevent="submitForm" class="space-y-4 md:space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                            <input type="text" v-model="form.name" name="name" id="name" placeholder="Your name" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0" required autofill="false">
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">E-mail:</label>
                            <input type="email" v-model="form.email" name="email" id="email" placeholder="name@example.com" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0" required autofill="false">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password:</label>
                            <input type="password" v-model="form.password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0" required>
                        </div>
                        <div>
                            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password:</label>
                            <input type="password" v-model="form.password_confirmation" name="password_confirmation" id="password_confirmation" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0" required>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required>
                                </div>
                                <div class="ml-2 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">
                                        I accept the
                                        <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Terms and Conditions</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-linear duration-500">Sign in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Already have an account? <a href="/login" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Log in</a>
                        </p>
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
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                is_active: false,
            }
        };
    },
    methods: {
        submitForm() {
            axios.post('/signup/store', this.form)
                .then((response) => {
                    window.location.href = '/login?success=Registration successful! You can Log in.';
                })
                .catch((error) => {
                    if (error.response && error.response.data) {
                        const errorMessage = error.response.data.message || 'An unexpected error occurred';
                        this.$refs.alerts.showAlert(errorMessage, 'error');
                    } else {
                        this.$refs.alerts.showAlert('An unexpected error occurred', 'error');
                    }
                });
        }
    }
};
</script>
