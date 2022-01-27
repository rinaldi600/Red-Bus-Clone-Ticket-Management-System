<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list text-white" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/DashboardAdmin">List Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/DashboardSupir">List Supir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/DashboardUser">List User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/DashboardTempat">List Tempat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/DashboardHarga">List Harga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/DashboardOrder">List Orderan</a>
                </li>
                <li class="nav-item dropdown menu-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Pengaturan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <form class="d-grid justify-content-center" action="/DashboardAdmin/logout" method="post">
                                <button type="submit" class="btn btn-outline-success">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>