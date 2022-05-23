<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_01.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success1"><b>Books & co</b></h1>
                            <h3 class="h2">Découvrez nos livres</h3>
                            <p>
                                <a rel="sponsored" class="text-success1" href="index.php?controller=browse&action=listBook" target="_blank">Ici</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_02.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Notez</h1>
                            <h3 class="h2">Vos livres préférés</h3>
                            <p>
                                <strong>Et commentez les</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="./assets/img/banner_img_03.jpg" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Créez un compte</h1>
                            <h3 class="h2">Dès maintenant</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Hero -->

<!-- Start 5 last Product -->
<section class="MothProducts">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Ajout récents</h1>
                <p>
                    Les 5 livres dérnièrement ajouter
                </p>
            </div>
        </div>
        <?php
        $books = $_SESSION['allBooks'];
        ?>
        <div class="row justify-content-around">
        <?php
        if(count($books) >= 5){
            $numberToShow = 5;
        }else{
            $numberToShow = count($books);
        }
        for ($i=0; $i < $numberToShow; $i++) { 
            ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="w-100 d-flex justify-content-around my-2 imagesBooksContent">
                            <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$books[$i]['idBook']?>">
                                <img src="resources/booksImage/<?=$books[$i]['booPicture']?>" class="card-img-top" alt="Image of one of the 5 last added books">
                            </a>
                        </div>
                        <div class="card-body border-top">
                            <p class="text-black">Reviews : <?=$_SESSION['numberComments'][$i];?></p>
                            <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$books[$i]['idBook'];?>" class="h2 text-decoration-none text-dark mb-5"><?=$books[$i]['booTitle']?></a>
                        </div>
                    </div>
                </div>
                <?php
        }

        // Delete the session variable
        unset($_SESSION['allBooks']);
        ?>
        </div>
    </div>
</section>
<!-- End Month Product -->