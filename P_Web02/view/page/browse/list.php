<?php
if(isset($_GET['search'])){
    ?>
    <p class="mt-3 ms-5">Recherche : <span class="font-weight-bold"><?=$_GET['search'];?></span></p>
    <?php
}
?>
<div class="row justify-content-around">
    <?php
    $books = $_SESSION['allBooks'];

    if($books){
        foreach ($books as $key => $value){ 
        ?>
        <div class="col-12 col-md-4 mb-4">
            <div class="card h-100">
                <div class="w-100 d-flex justify-content-around my-2 imagesBooksContent">
                    <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$books[$key]['idBook'];?>">
                        <img src="../../../../../P_Web02/P_Web02/resources/booksImage/<?=$books[$key]['booPicture'];?>" class="card-img-top" alt="Image of the book">
                    </a>
                </div>
                <div class="card-body border-top">
                    <p class="text-muted">Reviews : <?=$_SESSION['numberComments'][$key];?></p>
                    <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$books[$key]['idBook'];?>" class="h2 text-decoration-none text-dark mb-5"><?=$books[$key]['booTitle'];?></a>
                </div>
            </div>
        </div>
        <?php
        }
    }else{
        ?>
        <h1 class="w-100 text-center mt-5 mb-5">Aucuns résultats ne correspond a votre recherche</h1>
        <?php
    }
    unset($_SESSION['allBooks']);
    ?>
</div>