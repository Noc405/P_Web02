<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flexs justify-content-between align-items-center">

        <a class="navbar-brand text-success2 logo h1 align-self-center" href="index.html">
            Zay
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=home&action=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=browse&action=listBook">Books</a>
                    </li>
                    <?php
                    if(isset($_SESSION['id'])){
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=books&action=addBooks">Add a book</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>
                </div>
                <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal" data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>
            </div>
            <div class="navbar align-self-center d-flex divTest">
                <?php
                if(isset($_SESSION['username'])){
                ?>
                    <div class="ContentLogout">
                        <span class="nameUserConnected"><?=$_SESSION['username'];?></span>
                        <button class="btn btn-primary" onclick="window.location.href = 'index.php?controller=log&action=logout';">Se déconnecter</button>
                    </div>
                <?php
                }else{
                ?>
                    <div class="contentLogin">
                        <button class="btn" onclick="window.location.href = 'index.php?controller=log&action=login';">Se connecter</button>
                        <button class="btn btn-primary" onclick="window.location.href = 'index.php?controller=log&action=signin';">S'inscrire</button>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

    </div>
</nav>
<!--Search input-->
<div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="w-100 pt-1 mb-5 text-right">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="index.php?controller=books&action=addBook&" method="get" class="modal-content modal-body border-0 p-0">
            <div class="input-group mb-2">
                <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                <button type="submit" class="input-group-text bg-success text-light" name="btnSubmit">
                    <i class="fa fa-fw fa-search text-white"></i>
            </button>
            </div>
        </form>
    </div>
</div>
<body>