<?php
 $book = $_SESSION['book'];
?>
<div class="d-flex justify-content-around my-5">
        <div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card-body text-center">
                    <i class="fa fa-fw fa-check-circle text-dark mr-1 mt-2 text-success1"></i>
                    <?php
                        if(isset($_GET['error'])){
                            if($_GET['error'] == 1){
                        ?>
                            <div class="w-100 text-center mt-5">
                                <p class="text-danger">Veuillez noter le livre avec des nombres valides comme l'exemple ci-dessous</p>
                            </div>
                        <?php
                            }
                        }
                    ?>
                    <form method="post" action="index.php?controller=vote&action=checkVoteBook&idBook=<?=$book[0]['idBook'];?>">
                        <label for="notMark" class="mt-4">Note : (1, 1.5, ... 5)</label><br>
                        <input type="text" name="notMark" class="inputForm" required><br>
                        <label for="notCommentary" class="mt-4">Commentaire :</label><br>
                        <textarea name="notCommentary" class="inputForm" required></textarea><br>
                        <input type="submit" name="btnSubmit" value="Noter" class="mt-5 btn-success">
                    </form>
                    <br>
                </div>
                <div class="w-100 text-center mb-5">
                    <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$book[0]['idBook'];?>" class="text-decoration-none text-success2"><strong>Retour à la page de détail</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>