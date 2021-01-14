<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <router-link class="navbar-brand" tag="a" to="/" exact>
        Articles
    </router-link>

    <button
        type="button"
        class="navbar-toggler"

        data-toggle="collapse"
        data-target="#navbarSupportedContent"

        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="mr-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/" exact>
                        Home
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/contact">
                        My Articles
                    </router-link>
                </li>
            </ul>
        </div>

        <div class="ml-auto">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/login">
                        Login
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link class="nav-link" tag="a" to="/register">
                        Register
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
