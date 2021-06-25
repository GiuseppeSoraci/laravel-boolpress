<template>
  <div>
    <Header />

    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
import axios from "axios";
import Header from "./components/Header.vue";

export default {
  name: "App",
  components: {
    Header,
  },
};
</script>

<style lang="scss">
@import "../sass/frontoffice/_utilities.scss";

body {
  font-family: Arial, Helvetica, sans-serif;
}
</style>
