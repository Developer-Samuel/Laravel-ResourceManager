<template>
    <div v-if="alertMessage" class="px-6 pt-6">
        <div v-if="alertType === 'success'"
            class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
            role="alert"
        >
            <div>
                {{ alertMessage }}
            </div>
        </div>
        <div v-if="alertType === 'error'"
            class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert"
        >
            <div>
                {{ alertMessage }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            alertMessage: '',
            alertType: '',
        };
    },
    methods: {
        showAlert(message, type) {
            this.alertMessage = Array.isArray(message) ? message[0] : message;
            this.alertType = type;
        },
        clearAlert() {
            this.alertMessage = '';
            this.alertType = '';
        },
    }
};
</script>
