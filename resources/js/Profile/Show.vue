<template>
    <div class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center py-8 h-screen h-auto lg:py-0 px-4 py-12">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 md:max-w-xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <a href="/profile/edit" class="flex justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-linear duration-500">
                    Edit profile
                </a>
                <div class="px-6 pt-8 pb-10 space-y-4 md:space-y-6 sm:px-8 sm:pt-8 sm:pb-12">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Profile
                    </h1>
                    <div class="text-lg text-black dark:text-white">
                        <div class="space-y-4 md:space-y-6">
                            <b>
                                Name:
                            </b>
                            <span class="ml-1">
                                {{ name }}
                            </span>
                        </div>
                        <div class="space-y-4 md:space-y-6">
                            <b>
                                E-mail:
                            </b>
                            <span class="ml-1">
                                {{ email }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: Object,
    },
    data() {
        return {
            name: this.user.name,
            email: this.user.email,
        };
    }
};
</script>
