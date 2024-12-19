<template>
    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center py-8 h-screen h-auto lg:py-0 px-4 py-12">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 md:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <alerts ref="alerts"></alerts>
                <div class="px-6 pt-8 pb-10 space-y-4 md:space-y-6 sm:px-8 sm:pt-8 sm:pb-12">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Edit project
                    </h1>
                    <form @submit.prevent="updateProject">
                        <div class="space-y-4 md:space-y-6">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name:</label>
                                <input
                                    type="text"
                                    v-model="name"
                                    name="name"
                                    id="name"
                                    placeholder="Name of project"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 outline-0"
                                    required
                                >
                            </div>
                            <div>
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                <select
                                    v-model="status"
                                    name="status"
                                    id="status"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option v-for="option in statuses" :key="option.value" :value="option.value">
                                        {{ option.label }}
                                    </option>
                                </select>
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
        project: Object,
        statuses: Array,
    },
    data() {
        return {
            id: this.project.id,
            name: this.project.name,
            status: this.project.status,
            url: this.project.url,
        };
    },
    methods: {
        updateProject() {
            const data = {
                id: this.id,
                name: this.name,
                status: this.status,
                url: this.url,
            };

            axios.post(`/projects/update/${this.id}`, data)
                .then(response => {
                    this.$refs.alerts.showAlert(response.data.message || 'Project updated successfully!', 'success');
                })
                .catch(error => {
                    const errorMessage = error.response && error.response.data.message
                        ? error.response.data.message
                        : 'Error updating project!';
                    this.$refs.alerts.showAlert(errorMessage, 'error');
                });
        }
    }
};
</script>
