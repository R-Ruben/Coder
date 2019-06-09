<template>
  <div class="col-md-3">
    <div class="card card-default friend-list">
      <div class="card-header">Friends</div>
      <div class="card-body">
        <ul class="list-unstyled">
          <li v-for="(friend,index) in friends" :key="index">
            <a :href="getChatLink(friend.id)">
              <div class="row chat-friend tr-link">
                <img class="chat-picture" :src="getProfilePicture(friend.profile_picture)">
                <span class="chat-name">{{friend.name}}</span>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["friends"],

  methods: {
    getProfilePicture(id) {
      return "../storage/profile-pictures/" + id;
    },

    getChatLink(id) {
      return "../chat/" + id;
    }
  }
};
</script>
