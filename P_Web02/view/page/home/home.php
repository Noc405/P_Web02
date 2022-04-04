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
                            <h1 class="h1 text-success1"><b>Nom du site</b> Vente de livre</h1>
                            <h3 class="h2">Subtitle</h3>
                            <p>
                                Text
                                <a rel="sponsored" class="text-success1" href="#" target="_blank">Lien</a>.
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
                            <h1 class="h1">Title</h1>
                            <h3 class="h2">Subtitle</h3>
                            <p>
                                Text normal
                                <strong>Text en gras</strong>
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
                            <h1 class="h1">Title</h1>
                            <h3 class="h2">Subtitle</h3>
                            <p>
                                Text
                                <strong>Text en gras</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Banner Hero -->

<!-- Start Month Product -->
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
        <div class="row justify-content-around">
        <?php
        for ($i=0; $i < 5; $i++) { 
            ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="w-100 d-flex justify-content-around my-2 imagesBooksContent">
                            <a href="index.php?controller=detailsBook&action=detailOneBook">
                                <img src="../../../../../P_Web02/P_Web02/resources/booksImage/1.jpg" class="card-img-top" alt="Image of one of the 5 last added books">
                            </a>
                        </div>
                        <div class="card-body border-top">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                            </ul>
                            <a href="index.php?controller=detailsBook&action=detailOneBook" class="h2 text-decoration-none text-dark">Test</a>
                            <p class="card-text">
                                Description
                            </p>
                            <p class="text-muted">Reviews ($numbers)</p>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>
        </div>
    </div>
</section>
<!-- End Month Product -->