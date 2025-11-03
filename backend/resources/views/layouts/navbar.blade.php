<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
      @auth
        <button class="navbar-toggler" type="button"
                data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
          {{--            @auth--}}
          <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('questions.index')}}">
                            <span data-feather="file"></span>
                            Questions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('topics.index')}}">
                            <span data-feather="layers"></span>
                            Topics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('respondents.index')}}">
                            <span data-feather="users"></span>
                            Respondents
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('report.index')}}">
                            <span data-feather="bar-chart-2"></span>
                            Reports
                        </a>
                    </li>
                </ul>
          {{--        @endauth--}}

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
                <!-- Guest Links -->
                <li class="nav-item">
                   <form method="POST" action="{{ route('logout') }}">
                      @csrf
                     <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                          {{ __('Log Out') }}
                      </a>
                  </form>
                </li>
            </ul>

        </div>
        @endauth
    </div>
</nav>

