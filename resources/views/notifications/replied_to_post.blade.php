<div class="dropdown-item notification">
 <img src="/storage/profile-pictures/{{ $notification->data['user']['profile_picture'] }}" class="notif-picture">
        <a href="/profiles/{{ $notification->data['user']['id'] }}"> 
            {{ $notification->data['user']['name'] }}
        </a> commented on 
    <a href="/posts/{{ $notification->data['post']['id'] }}"> 
        your post.
    </a>

</div>