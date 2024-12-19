<template>
    <div class="relative w-full min-h-screen h-auto bg-gray-50 dark:bg-gray-700 flex flex-col items-center">
        <div class="text-4xl font-bold text-center text-black dark:text-white mt-24">
            Projects
        </div>
        <div class="flex justify-center mt-10">
            <a href="/projects/create" class="bg-green-500 text-black text-lg font-bold rounded-full px-3 py-1">Create</a>
        </div>
        <table class="relative lg:w-[980px] w-full text-sm text-left rtl:text-right text-black dark:text-white border border-solid border-gray-600 dark:border-gray-500 my-10">
            <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-black dark:text-gray-400 border-b border-solid border-gray-600 dark:border-gray-500">
                <tr>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">URL</th>
                    <th scope="col" class="text-right px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects" :key="project.id" class="bg-gray-50 dark:bg-gray-800 border-b border-gray-600 dark:border-gray-500 font-bold">
                    <th scope="row" class="px-6 py-4">{{ project.name }}</th>
                    <td class="px-6 py-4">{{ project.url }}</td>
                    <td class="text-right  px-6 py-4">{{ project.status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        projects: Array,
        role: String,
    },
};
</script>

