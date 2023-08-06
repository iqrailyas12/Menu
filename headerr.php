<header class="main-header navbar">
    <div class="col-search">
        <form class="searchform" method="post" action="order.php">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search user order" autocomplete="off">
                <button class="btn btn-light bg" name="submit" type="submit"> <i class="material-icons md-search"></i>
                </button>
            </div>

        </form>
    </div>
    <div class="col-nav">
        <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="md-28 material-icons md-menu"></i> </button>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link btn-icon" onclick="darkmode(this)" title="Dark mode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-icon" href="#"> <i class="material-icons md-notifications_active"></i>
                </a>
            </li>
            <li class="nav-item">
                        <a class="nav-link" href="#"> Welcome
                            <?php
                            echo  $_SESSION["admin"];
                            ?> </a>
                    </li>
            <li class="dropdown nav-item">
                <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#"> <img class="img-xs rounded-circle" src="images/avatar/8.jpg" alt="User"></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">My profile</a>
                   
                    <a class="dropdown-item text-danger" href="logout.php">Exit</a>
                </div>
            </li>
        </ul>
    </div>
</header>