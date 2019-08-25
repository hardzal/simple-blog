<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <div class="container">
            <a href="./home" class="navbar-brand font-weight-bold"><img src="assets/img/itc.png" alt="logo" class="mr-3">ITC UPNYK</a>
            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <?php if (!$cekLogin) { ?>
                    <a class="nav-item nav-link font-weight-bold" href="login">Login</a>
                    <a class="nav-item nav-link font-weight-bold" href="signup">Sign Up</a>
                    <?php } else { ?>
                    <a class="nav-item nav-link font-weight-bold" href="home">Home</a>
                    <a class="nav-item nav-link font-weight-bold" href="dashboard&p=logout">Logout</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>