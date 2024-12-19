<template>
    <div class="fixed top-0 flex md:flex-row flex-col md:justify-between justify-center items-center w-full md:h-[60px] h-[80px] bg-white dark:bg-black text-black dark:text-black border-b border-solid border-black dark:border-white px-4 z-[1000]">
        <a href="/" class="md:text-2xl text-xl font-bold text-black dark:text-white pb-1">
            ResourceManager
        </a>
        <div class="flex items-center font-bold">
            <a
                v-if="isAdmin && currentUrl !== '/admin/users'"
                href="/admin/users"
                class="flex items-center w-auto h-[35px] bg-transparent text-black dark:text-white rounded-lg px-3"
            >
                <span>Users</span>
            </a>
            <a
                v-else-if="isAdmin"
                href="/projects"
                class="flex items-center w-auto h-[35px] bg-transparent text-black dark:text-white rounded-lg px-3"
            >
                <span>Projects</span>
            </a>
            <a
                v-else-if="!isAdmin && currentUrl !== '/profile'"
                href="/profile"
                class="flex items-center w-auto h-[35px] bg-transparent text-black dark:text-white rounded-lg px-3"
            >
                <span>Profile</span>
            </a>
            <a
                v-else
                href="/projects"
                class="flex items-center w-auto h-[35px] bg-transparent text-black dark:text-white rounded-lg px-3"
            >
                <span>Projects</span>
            </a>
            <button @click="logout" class="flex items-center w-auto h-[35px] bg-transparent text-black dark:text-white rounded-lg px-3">
                <span>
                    Log out
                </span>
            </button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Header',
    data() {
        return {
            currentUrl: window.location.pathname,
            user: null,
        };
    },
    computed: {
        isAdmin() {
            return this.user?.role === 'admin';
        }
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get('/user')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.error("Error fetching user data:", error);
                });
        },
        logout() {
            axios.post('/logout')
                .then(response => {
                    window.location.href = '/login';
                })
                .catch(error => {
                    alert("An error occurred while logging out.");
                });
        }
    }
};
</script>
