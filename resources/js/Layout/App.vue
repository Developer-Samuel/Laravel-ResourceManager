<template>
    <div :class="{'overflow-hidden': isLoading}" class="transition duration-500">
        <transition name="fade">
            <loading v-if="isLoading"></loading>
        </transition>
        <header-component v-if="!hiddenHeader"></header-component>
        <slot></slot>
    </div>
</template>

<script>
import Loading from '../Components/Loading.vue';
import Header from '../Includes/Header.vue';

export default {
  name: 'Layout',
  components: {
    'loading': Loading,
    'header-component': Header,
  },
  data() {
    return {
      isLoading: true,
    };
  },
  computed: {
    hiddenHeader() {
      const currentUrl = window.location.pathname;
      return currentUrl.includes('login') || currentUrl.includes('signup');
    },
  },
  mounted() {
    setTimeout(() => {
      this.isLoading = false;
    }, 1000);
  },
};
</script>

<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s ease-in;
}
.fade-enter-from, .fade-leave-to {
    opacity: 0;
}
</style>

