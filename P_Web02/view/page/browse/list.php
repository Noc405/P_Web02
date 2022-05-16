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
                    <!--Ajout les notes dynamiquement-->
                    <ul class="list-unstyled d-flex justify-content-between">
                        <li>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-warning fa fa-star"></i>
                            <i class="text-muted fa fa-star"></i>
                            <i class="text-muted fa fa-star"></i>
                        </li>
                    </ul>
                    <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$books[$key]['idBook'];?>" class="h2 text-decoration-none text-dark"><?=$books[$key]['booTitle'];?></a>
                    <p class="card-text">
                        <a href="../../../../../P_Web02/P_Web02/resources/booksExctract/<?=$books[$key]['booExtract'];?>"><?=$books[$key]['booExtract'];?></a>
                    </p>
                    <p class="text-muted">Reviews ($numbers)</p>
                </div>
            </div>
        </div>
        <?php
        }
    }else{
        echo"Pas de livre trouvés";
    }
    unset($_SESSION['allBooks']);
    ?>
</div>