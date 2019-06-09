<template>
  <div class="like-controls pull-right">
    <i v-on:click="repPost(1)" class="far fa-thumbs-up"></i>
    &nbsp;
    <i v-on:click="repPost(-1)" class="far fa-thumbs-down"></i>
  </div>
</template>

<script>
export default {
  props: ["user", "post"],

  // data() {
  //   return {
  //     messages: [],
  //     newMessage: "",
  //     activeUser: false,
  //     typingTimer: false
  //   };
  // },

  created() {
    // this.getCurrentLike();
  },

  methods: {
    repPost(score) {
      axios.post("../reputations", {
        sending_id: this.user.id,
        receiving_id: this.post.user.id,
        post_id: this.post.id,
        score: score
      });
    }

    // getCurrentLike() {
    //   axios
    //     .get("../reputations/", {
    //       params: {
    //         post_id: this.post.id,
    //         sending_id: this.user.id
    //       }
    //     })
    //     .then(response => {
    //       if (response.data == 1) {

    //         var likeButtons = document.getElementsByClassName("fa-thumbs-up");

    //         for (var i = 0; i < likeButtons.length; i++) {
    //           likeButtons[i].style.color = rgb(85,255,170);
    //         }

    //       }
    //     });
    // }
  }
};
</script>
