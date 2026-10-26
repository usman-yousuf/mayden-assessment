<header class="site-header">
    <div class="container header-container">

        <div class="header-left">
            <h1>Grocery Shopping List</h1>

            <nav aria-label="Main navigation">
                @auth
                    <a href="{{ route('shopping-lists.index') }}" @if(request()->routeIs('shopping-lists.index')) aria-current="page" @endif>Shopping Lists</a>
                @endauth
            </nav>
        </div>

        <div class="header-right">
            @auth
                <span>Welcome, {{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>

    </div>
</header>
