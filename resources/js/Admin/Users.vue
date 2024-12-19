<template>
    <div class="relative w-full  min-h-screen h-auto bg-gray-50 dark:bg-gray-700 flex flex-col items-center">
        <div class="text-4xl font-bold text-center text-black dark:text-white mt-24">
            Users
        </div>
        <table class="relative lg:w-[980px] w-full text-sm text-left rtl:text-right text-black dark:text-white border border-solid border-gray-600 dark:border-gray-500 my-10">
            <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-black dark:text-gray-400 border-b-[1px] border-solid border-gray-600 dark:border-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" :key="user.id" class="bg-gray-50 dark:bg-gray-800 border-b border-gray-600 dark:border-gray-500 font-bold">
                    <th scope="row" class="px-6 py-4">{{ user.name }}</th>
                    <td class="px-6 py-4">{{ user.email }}</td>
                    <td class="px-6 py-4">{{ user.role }}</td>
                    <td class="px-6 py-4 text-right">
                        <a v-if="user.projects_count > 0"
                           :href="'/admin/projects/' + user.id"
                           class="bg-blue-600 text-white text-md font-bold rounded-full px-3 py-1.5"
                        >
                            Projects
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        users: Array,
    },
};
</script>

