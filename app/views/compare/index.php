<?php include __DIR__ . '/../header.php'; ?>

    <div class="container">
        <div class=" d-flex justify-content-center">
            <h2>All Pre-Cons</h2>
        </div>
        <div class="row">
                <?php foreach ($preCons as $preCon): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class=" d-flex justify-content-center">
                            <h5 class="card-title d-flex justify-content-center"><?php echo $preCon['pre_con_name']; ?></h5>
                        </div>
                        <div class="card-body ">
                            <img src="<?php echo $preCon['image']; ?>" class="card-img-top p-3" alt="Pre-Con Image">
                            <div class=" d-flex justify-content-center">
                                <a href="/compare?id=<?php echo $preCon['id']; ?>" class="btn btn-primary">Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


<?php include __DIR__ . '/../footer.php';
