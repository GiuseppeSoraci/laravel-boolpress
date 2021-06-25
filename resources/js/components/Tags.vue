<template>
  <div class="tags">
    <span v-for="tag in tags" :key="`tag-${tag.id}`" class="tag">
      {{ tag.name }}
    </span>
  </div>
</template>

<script>
export default {
  name: Tags,
  props: {
    tags: Array,
  },
};
</script>

<style>
.tags {
  display: inline-block;
}

.tag {
  display: inline-block;
  margin: 25rem;
  padding: 0 25rem;
  font-size: 0.75em;
  background: lightblue;
  border-radius: 15px;
}
</style>
