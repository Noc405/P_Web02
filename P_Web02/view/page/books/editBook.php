<div class="d-flex justify-content-around my-5">
        <div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card-body text-center">
                    <i class="fa fa-fw fa-book text-dark mr-1 text-success1"></i>
                    <h3 class="text-success1">Editer un livre</h1>
                    
                    <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == 1){
                    ?>
                        <div class="w-100 text-center mt-5">
                            <p class="text-danger">Veuillez renseigner correctement les champs</p>
                        </div>
                    <?php
                        }
                    }
                    ?>

                    <?php
                        $authorsGet = $_SESSION['authors'];
                        $categoriesGet = $_SESSION['categories'];
                        $editorsGet = $_SESSION['editors'];
                        $bookInfos = $_SESSION['bookInfos'];

                    ?>

                    <form method="post" action="index.php?controller=books&action=checkEditBook&idBook=<?=$_GET['idBook'];?>">
                        <label for="title" class="mt-4">Titre :</label><br>
                        <input type="text" name="title" class="inputForm" value="<?=$bookInfos[0]['booTitle'];?>" required><br>
                        <label for="nbPages" class="mt-3">Nombre de pages : </label><br>
                        <input type="number" name="nbPages" class="inputForm"  value="<?=$bookInfos[0]['booPage'];?>" required><br>
                        <label for="abstract" class="mt-4">Résumé :</label><br>
                        <textarea name="abstract" class="inputForm"  required><?=$bookInfos[0]['booAbstract'];?></textarea><br>
                        <label for="date" class="mt-4">Date de sortie du livre : (yyyy)</label><br>
                        <input type="text" name="date" class="inputForm" value="<?=$bookInfos[0]['booDate'];?>" required><br>
                        <label for="author" class="mt-4">Auteur :</label><br>
                        <select name="author" class="inputForm" required> 
                            <option value="0">Auteur inconnu / autre</option>
                            <?php
                                foreach ($authorsGet as $key => $value) {
                                    if($authorsGet[$key]['idAuthor'] == $bookInfos[0]['fkAuthor']){
                                        ?>
                                        <option selected value="<?=$authorsGet[$key]['idAuthor'];?>"><?=$authorsGet[$key]['autName'] . " " . $authorsGet[$key]['autSurname'];?></option>
                                        <?php
                                    }else{
                                        ?>
                                        <option value="<?=$authorsGet[$key]['idAuthor'];?>"><?=$authorsGet[$key]['autName'] . " " . $authorsGet[$key]['autSurname'];?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select><br>
                        <label for="category" class="mt-4">Catégorie :</label><br>
                        <select name="category" class="inputForm" required>
                            <option value="0">Autre</option>
                            <?php
                                foreach ($categoriesGet as $key => $value) {
                                    if( $categoriesGet[$key]['idCategory'] == $bookInfos[0]['fkCategory']){
                                    ?>
                                    <option selected value="<?=$categoriesGet[$key]['idCategory'];?>"><?=$categoriesGet[$key]['catName']?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="<?=$categoriesGet[$key]['idCategory'];?>"><?=$categoriesGet[$key]['catName']?></option>
                                    <?php
                                }
                            }

                            ?>
                        </select><br>
                        <label for="editor" class="mt-4">Editeur :</label><br>
                        <select name="editor" class="inputForm" required>
                            <option value="0">Autre</option>
                            <?php
                                foreach ($editorsGet as $key => $value) {
                                    if( $editorsGet[$key]['idEditor'] == $bookInfos[0]['fkEditor']){
                                    ?>
                                    <option selected value="<?=$editorsGet[$key]['idEditor'];?>"><?=$editorsGet[$key]['ediName']?></option>
                                    <?php
                                }else{
                                    ?>
                                    <option value="<?=$editorsGet[$key]['idEditor'];?>"><?=$editorsGet[$key]['ediName']?></option>
                                    <?php
                                }
                             }

                            ?>
                        </select><br>
                        <input type="submit" name="btnSubmit" value="Suivant" class="mt-5 btn-success">
                    </form>
                    <br>
                </div>
                <div class="w-100 text-center mb-5">
                    <a href="index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$_GET['idBook']?>" class="text-decoration-none text-success2"><strong>Retour à la page du livre</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>