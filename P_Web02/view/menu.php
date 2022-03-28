<div class="container">
    <div class="masthead">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">BOOKS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav nav-fill me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="../P_Web02/index.php?controller=home&action=home">Acceuil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../P_Web02/index.php?controller=browse&action=listBook">Parcourir</a>
                    </li>
                </ul>

                        <?php
                        if(isset($_SESSION['userName'])){
                        ?>
                            <div class="w-50 d-inline-flex justify-content-between">
                                <div>
                                    <span class="text-white" style="letter-spacing: 1.5px;"><?=/*$_SESSION['name'];*/"emilien"?></span>
                                    <button class="btn btn-secondary my-2 my-sm-0">Se déconnecter</button>

                        <?php
                        }else{
                        ?>
                            <div class="w-75 d-inline-flex justify-content-between">
                                <div>
                                    <button class="btn btn-secondary my-2 my-sm-0" onclick="window.location.href = 'index.php?controller=log&action=signin';">S'inscrire</button>
                                    <button class="btn btn-secondary my-2 my-sm-0" onclick="window.location.href = 'index.php?controller=log&action=login';">Se connecter</button>
                        <?php
                        }
                        ?>
                    </div>

                    <form class="d-flex">
                        <input class="form-control me-sm-2" type="text" placeholder="Search a category">
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
            </div>
        </nav>