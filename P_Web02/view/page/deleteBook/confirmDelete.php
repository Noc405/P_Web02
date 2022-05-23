<div class="d-flex justify-content-around my-5">
        <div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card-body text-center">
                    <i class="fa fa-fw fa-trash text-dark mr-1 text-success1"></i>
                    <h3 class="text-success1">Êtes-vous sûr de vouloir supprimer ce livre ?</h1>
                    <div class="d-flex justify-content-around w-100 contentButtonDelete">
                        <form class="d-flex justify-content-around w-100" action="index.php?controller=books&action=deleteBook&idBook=<?=$_GET['idBook'];?>" method="post">
                            <input type="submit" name="btnDelete" class="mt-5 btn btn-success" value="Supprimer">
                            <input type="submit" name="btnBack" class="mt-5 btn btn-success" value="Garder">
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>