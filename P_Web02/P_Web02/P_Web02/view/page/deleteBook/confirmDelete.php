<div class="d-flex justify-content-around my-5">
        <div class="col-md-4">
            <div class="card mb-4 product-wap rounded-0">
                <div class="card-body text-center">
                    <i class="fa fa-fw fa-trash text-dark mr-1 text-success1"></i>
                    <h3 class="text-success1">Êtes-vous sûr de vouloir supprimer ce livre ?</h1>
                    <div class="d-flex justify-content-around w-100 contentButtonDelete">
                        <button class="mt-5 btn btn-success" onclick="window.location.href='index.php?controller=books&action=deleteBook&idBook=<?=$_GET['idBook'];?>';">Supprimer</button>
                        <button class="mt-5 btn btn-success" onclick="window.location.href='index.php?controller=detailsBook&action=detailOneBook&idBook=<?=$_GET['idBook'];?>';">Garder</button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>