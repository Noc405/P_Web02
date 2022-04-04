<div class="d-flex justify-content-around my-5">
        <div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card-body text-center">
                    <i class="fa fa-fw fa-book text-dark mr-1 text-success1"></i>
                    <h3 class="text-success1">Ajouter un livre</h1>
                    
                    <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == 1){
                    ?>
                        <div class="w-100 text-center mt-5">
                            <p class="text-danger">Veuillez renseigner correctement les champs</p>
                        </div>
                    <?php
                        }elseif($_GET['error'] == 2){
                            ?>
                        <div class="w-100 text-center mt-5">
                            <p class="text-danger">Ce livre existe déjà</p>
                        </div>
                            <?php
                        }
                    }
                    ?>

                    <?php
                        $authorsGet = $_SESSION['authors'];
                        $categoriesGet = $_SESSION['categories'];
                        $editorsGet = $_SESSION['editors'];
                    ?>

                    <form method="post" action="index.php?controller=books&action=checkAddBook">
                        <label for="title" class="mt-4">Titre :</label><br>
                        <input type="text" name="title" class="inputForm" required><br>
                        <label for="nbPages" class="mt-3">Nombre de pages : </label><br>
                        <input type="number" name="nbPages" class="inputForm" required><br>
                        <label for="abstract" class="mt-4">Résumé :</label><br>
                        <textarea name="abstract" class="inputForm" required></textarea><br>
                        <label for="date" class="mt-4">Date de sortie du livre :</label><br>
                        <input type="date" name="date" class="inputForm" required><br>
                        <label for="author" class="mt-4">Auteur :</label><br>
                        <select name="author" class="inputForm" required>
                            <option value="0">Auteur inconnu / autre</option>
                            <?php
                                foreach ($authorsGet as $key => $value) {
                                    ?>
                                    <option value="<?=$authorsGet[$key]['idAuthor'];?>"><?=$authorsGet[$key]['autName'] . " " . $authorsGet[$key]['autSurname'];?></option>
                                    <?php
                                }
                            ?>
                        </select><br>
                        <label for="category" class="mt-4">Catégorie :</label><br>
                        <select name="category" class="inputForm" required>
                            <option value="0">Autre</option>
                            <?php
                                foreach ($categoriesGet as $key => $value) {
                                    ?>
                                    <option value="<?=$categoriesGet[$key]['idCategory'];?>"><?=$categoriesGet[$key]['catName']?></option>
                                    <?php
                                }
                            ?>
                        </select><br>
                        <label for="editor" class="mt-4">Editeur :</label><br>
                        <select name="editor" class="inputForm" required>
                            <option value="0">Autre</option>
                            <?php
                                foreach ($editorsGet as $key => $value) {
                                    ?>
                                    <option value="<?=$editorsGet[$key]['idEditor'];?>"><?=$editorsGet[$key]['ediName']?></option>
                                    <?php
                                }
                            ?>
                        </select><br>
                        <input type="submit" name="btnSubmit" value="Suivant" class="mt-5 btn-success">
                    </form>
                    <br>
                </div>
                <div class="w-100 text-center mb-5">
                    <a href="index.php?controller=home&action=home" class="text-decoration-none text-success2"><strong>Retour à la page d'acceuil</strong></a>
                </div>
            </div>
        </div>
    </div>
</div>