<template>
    <div class="relative w-full min-h-screen h-auto bg-gray-50 dark:bg-gray-700 flex flex-col items-center">
        <div class="text-4xl font-bold text-center text-black dark:text-white mt-24">
            Projects
        </div>
        <div class="flex justify-center mt-10">
            <a href="/projects/create" class="bg-green-500 hover:bg-green-600 text-black text-lg font-bold rounded-full px-3 py-1 transition-linear duration-500">Create</a>
        </div>
        <table v-if="projects.length != 0" class="relative lg:w-[980px] w-full text-sm text-left rtl:text-right text-black dark:text-white border border-solid border-gray-600 dark:border-gray-500 my-10">
            <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-black dark:text-gray-400 border-b border-solid border-gray-600 dark:border-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">URL</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects" :key="project.id" class="bg-gray-50 dark:bg-gray-800 border-b border-gray-600 dark:border-gray-500 font-bold">
                    <th scope="row" class="px-6 py-4">{{ project.name }}</th>
                    <td class="px-6 py-4">{{ project.url }}</td>
                    <td class="px-6 py-4">{{ project.status }}</td>
                    <td class="px-6 py-4 text-right">
                        <div v-if="role == 'user'" class="flex items-center gap-2">
                            <a :href="'/projects/edit/' + project.url" class="bg-blue-600 hover:bg-blue-700 text-white text-md font-bold rounded-full px-3 py-1 transition-linear duration-500">
                                Edit
                            </a>
                            <a href="#" @click.prevent="deleteProject(project.id)" class="bg-red-600 hover:bg-red-700 text-white text-md font-bold rounded-full px-3 py-1 transition-linear duration-500">
                                Delete
                            </a>
                        </div>
                        <a v-else :href="'/projects/show/' + project.url" class="bg-blue-600 hover:bg-blue-700 text-white text-md font-bold rounded-full px-3 py-1 transition-linear duration-500">
                            Show
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        projects: Array,
        role: String,
    },
    methods: {
        deleteProject(id) {
            if (confirm('Are you sure you want to delete this project?')) {
                axios.post('/projects/delete', { id })
                    .then(response => {
                        alert('Project deleted successfully!');
                        this.removeProjectFromList(id);
                    })
                    .catch(error => {
                        console.error('Error deleting project:', error);
                    });
            }
        },
        removeProjectFromList(id) {
            const index = this.projects.findIndex(project => project.id === id);
            if (index !== -1) {
                this.projects.splice(index, 1);
            }
        }
    }
};
</script>

