 <!-- Open Content -->
<?php
    $book = $_SESSION['book'];
?>
 <section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3 imageBook">
                    <img class="card-img img-fluid" src="../../P_Web02/P_Web02/resources/booksImage/<?=$book[0]['booPicture']?>" alt="Card image cap" id="product-detail">                
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?=$book[0]['booTitle']?></h1>
                        <p class="h3 py-2">Total de page : <?=$book[0]['booPage']?></p>
                        <?php
                        if(isset($_SESSION['average']) && isset($_SESSION['nbComments'])){
                        ?>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating <?=$_SESSION['average'];?> | <?=$_SESSION['nbComments'];?> Comments | <a href="index.php?controller=vote&action=voteBook&idBook=<?=$book[0]['idBook'];?>">Noter ce livre</a></span>
                        </p>
                        <?php
                        }else{
                            ?>
                            <span class="list-inline-item text-dark">Pas de notes à ce livre | <a href="index.php?controller=vote&action=voteBook&idBook=<?=$book[0]['idBook'];?>">Noter ce livre</a></span>
                            <?php
                        }
                        ?>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Catégorie : <?=$book[0]['catName']?></h6>
                            </li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Sorti le :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p><?=$book[0]['booDate']?></p>
                            </li>
                        </ul>
                        <h6>Résumé:</h6>
                        <p><?=$book[0]['booAbstract']?></p>
                        

                        <h6>Spécification:</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Auteur : <?=$book[0]['autSurname']?> <?=$book[0]['autName']?></li>
                            <li>Éditeur : <?=$book[0]['ediName']?></li>
                            <li>Ajouté sur le site le : <?=$book[0]['booAddDate'][2] . " du " . $book[0]['booAddDate'][1] . " " . $book[0]['booAddDate'][0]?></li>
                            <li>Par l'utilisateur : <?=$book[0]['useUsername']?></li>
                        </ul>
                        <a href="../../P_Web02/P_Web02/resources/booksExtract/<?=$book[0]['booExtract'];?>">Lire un extrait</a>
                        <div class="row pb-3">
                            <div class="col d-grid">
                                <button type="submit" class="btn btn-success btn-lg" name="submit" value="edit" onclick="window.location.href = 'index.php?controller=books&action=jsp';">Éditer</button>
                            </div>
                            <div class="col d-grid">
                                <button type="submit" class="btn btn-success btn-lg" name="submit" value="delete" onclick="window.location.href = 'index.php?controller=books&action=confirmDelete&idBook=<?=$book[0]['idBook']?>';">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->