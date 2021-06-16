<template>
  <div>
    <Header />

    <main>
      <h2>Welcome to public home</h2>

      <p>Work in progress...</p>
    </main>
  </div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
  name: "App",
  components: {
    Header,
  },
};
</script>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}
</style>
