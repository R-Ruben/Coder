<template>
  <span>
    <button class="btn btn-success" v-on:click="handleFriendRequest(1)">Accept</button>
    <button class="btn btn-secondary" v-on:click="handleFriendRequest(-1)">Dismiss</button>
  </span>
</template>

<script>
export default {
  props: ["user", "correspondent"],

  methods: {
    handleFriendRequest(accepted) {
      axios.post("../friends/update", {
        user_id: this.user.id,
        correspondent_id: this.correspondent.id,
        accepted: accepted
      });
    }
  }
};
</script>
