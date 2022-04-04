<div class="d-flex justify-content-around my-5">
        <div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card-body text-center">
                    <i class="fa fa-fw fa-book text-dark mr-1 text-success1"></i>
                    <h3 class="text-success1">Ajouter une photo et un extrait</h1>
                    
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

                    <form method="post" enctype="multipart/form-data" action="index.php?controller=books&action=checkAddBookImagesAndExtract">
                        <label for="picture" class="mt-4">Image :</label><br>
                        <input type="file" name="picture" class="inputFormImage" required><br>
                        <label for="extract" class="mt-3">Extrait : </label><br>
                        <input type="file" name="extract" class="inputFormImage" required><br>
                        <input type="submit" name="btnSubmit" value="Créer le livre" class="mt-5 btn-success">
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