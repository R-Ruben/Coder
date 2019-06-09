<template>
  <button class="btn btn-primary" v-on:click="addFriend">Add as friend</button>
</template>

<script>
export default {
  props: ["user", "correspondent"],

  methods: {
    addFriend() {
      axios.post("../friends", {
        user_id: this.user.id,
        receiving_user_id: this.correspondent.id
      });
    }
  }
};
</script>
