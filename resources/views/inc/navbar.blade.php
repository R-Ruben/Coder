      <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                    Coder
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                                <a class="nav-link" href="/"><i class="fas fa-home"></i>&nbsp; Home</a>
                              </li>
                              
                        <li class="nav-item">
                                <a class="nav-link" href="/browse-posts"><i class="fas fa-columns"></i>&nbsp; Browse...</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="/chat"><i class="far fa-comments"></i>&nbsp; Chat</a>
                              </li>
                              <li class="nav-item pull-right">
                                    <a class="nav-link nav-highlight" href="/create">Create project</a>
                                  </li>
                            </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                    @auth
                    <li class="nav-item dropdown" id="markAsRead" onclick="markAsRead('{{ count(auth()->user()->unreadNotifications) }}')">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user-friends"></i>&nbsp; Friends &nbsp;</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <h6 class="dropdown-header">Friend requests</h6>

                            @forelse(App\Helpers\AppHelper::instance()->getFriendRequests() as $friendRequest)
                            <div class="dropdown-item notification">
                                
                                <img src="/storage/profile-pictures/{{ $friendRequest->profile_picture }}" class="notif-picture">
                                       <a href="/profiles/{{ $friendRequest->id }}"> 
                                           {{ $friendRequest->name }}
                                       </a> asked to be  your friend.
                                   <friend-controls :user="{{auth()->user()}}" :correspondent="{{$friendRequest}}"></friend-controls>    
                               </div>
                                @empty
                                <a class="dropdown-item" href="#">No friend requests</a>
                            @endforelse
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/friends" style="text-align:center">See all</a>
                        </div>
                        
                    </li>
                    

                    
                    <li class="nav-item dropdown" id="markAsRead" onclick="markAsRead('{{ count(auth()->user()->unreadNotifications) }}')">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="far fa-bell"></i>&nbsp; Notifications &nbsp;<span class="badge">{{ count(auth()->user()->unreadNotifications) }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               
                            @forelse(auth()->user()->unreadNotifications as $notification)
                                @include('notifications.'.snake_case(class_basename($notification->type)))
                                @empty
                                <a class="dropdown-item" href="#">No unread notifications</a>
                            @endforelse
                              
                        </div>
                        
                    </li>
                    @endauth

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @auth
                                    <a class="dropdown-item" href="/profiles/{{ Auth::user()->id }}">Profile</a>
                                    <a class="dropdown-item" href="/profiles/{{ Auth::user()->id }}/projects">My projects</a>
                                    <a class="dropdown-item" href="/applications">My applications</a>
                                    
                                  @endauth
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        
                    @endguest
                </ul>
            </div>
        </div>
    </nav>