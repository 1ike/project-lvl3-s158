    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home') }}">Pagespeed</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @php $isHome = $routeName == 'home' @endphp
                <li class="nav-item{{ $isHome ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">Home{!! $isHome ? ' <span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
                @php $isDomains = $routeName == 'domains' @endphp
                <li class="nav-item{{ $isDomains ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('domains') }}">Domains{!! $isDomains ? ' <span class="sr-only">(current)</span>' : '' !!}</a>
                </li>
<!--                 <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
            </ul>
        </div>
    </nav>