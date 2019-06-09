<template>
  <div id="chat" class="row">
    <friend-list :friends="friends"></friend-list>
    <div class="col-md-6">
      <div class="card card-default chat">
        <div class="card-body">
          <ul class="list-unstyled chat-window" v-chat-scroll>
            <li v-for="(message,index) in messages" :key="index">
              <div class="row message correspondent" v-if="message.user.id != user.id">
                <div class="col-1" style="padding:0px;margin-left:15px;">
                  <img
                    class="profile-picture"
                    :src="getProfilePicture(message.user.profile_picture)"
                  >
                </div>
                <div class="col-10">
                  <a :href="getProfileLink(message.user.id)">
                    <strong>{{message.user.name}}</strong>
                    - {{message.created_at}}
                  </a>
                  <br>
                  {{message.message}}
                </div>
              </div>

              <div class="row message user" v-if="message.user.id == user.id">
                <div class="col-11">
                  <a :href="getProfileLink(message.user.id)">
                    <strong>{{message.user.name}}</strong>
                    - {{message.created_at}}
                  </a>
                  <br>
                  {{message.message}}
                </div>
                <div class="col-1" style="padding:0px">
                  <img
                    class="profile-picture"
                    :src="getProfilePicture(message.user.profile_picture)"
                  >
                </div>
              </div>
            </li>
          </ul>
        </div>

        <input
          @keydown="sendTypingEvent"
          @keyup.enter="sendMessage"
          v-model="newMessage"
          type="text"
          name="message"
          placeholder="Write a message..."
          class="form-control"
        >
      </div>
      <span class="text-muted" v-if="activeUser">{{activeUser.name}} is typing...</span>
    </div>
    <div class="col-md-3">
      <div class="card card-default chat-info">
        <div class="card-header">
          <a :href="getProfileLink(correspondent.id)">
            <span>
              {{correspondent.name}}
              <span class="secondary-text">(#{{correspondent.id}})</span>
            </span>
          </a>
        </div>
        <div class="card-body">
          <img class="profile-picture" :src="getProfilePicture(correspondent.profile_picture)">
          <span>Reputation: {{correspondent.rep}}</span>
          <br>
          <div v-if="correspondent.country">
            <span>Lives in {{correspondent.country}}</span>
            <br>
          </div>

          <div v-if="correspondent.website">
            <span>
              <a :href="correspondent.website">{{correspondent.website}}</a>
            </span>
            <br>
          </div>

          <div v-if="correspondent.country">
            <span>Born on {{correspondent.birthDate}}</span>
            <br>
          </div>
          <br>
          <add-friend :user="user" :correspondent="correspondent"></add-friend>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["user", "correspondent", "friends"],

  data() {
    return {
      messages: [],
      newMessage: "",
      activeUser: false,
      typingTimer: false
    };
  },

  created() {
    this.getMessages();

    this.channel()
      .listen("MessageSent", event => {
        if (event.message.user.id == this.correspondent.id) {
          this.messages.push(event.message);
        }
      })
      .listenForWhisper("typing", user => {
        if (user.id == this.correspondent.id) {
          this.activeUser = user;

          if (this.typingTimer) {
            clearTimeout(this.typingTimer);
          }

          this.typingTimer = setTimeout(() => {
            this.activeUser = false;
          }, 3000);
        }
      });
  },

  methods: {
    getProfileLink(id) {
      return "../profiles/" + id;
    },

    getWebsite(id) {
      return "../storage/profile-pictures/" + id;
    },

    getProfilePicture(id) {
      return "../storage/profile-pictures/" + id;
    },

    channel() {
      return Echo.join(`chat.${this.user.id}`);
    },

    getMessages() {
      axios.get("messages/" + this.correspondent.id, {
        params: { correspondent: this.correspondent.id }
      });
    },

    sendMessage() {
      var today = new Date();
      var time =
        today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

      this.messages.push({
        user: this.user,
        message: this.newMessage,
        correspondent: this.correspondent,
        created_at: time
      });
      axios.post("messages/" + this.correspondent.id, {
        correspondent: this.correspondent.id,
        message: this.newMessage
      });
      this.newMessage = "";
    },

    sendTypingEvent() {
      return Echo.join(`chat.${this.correspondent.id}`).whisper(
        "typing",
        this.user
      );
    }
  }
};

$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
  }
});
</script>
