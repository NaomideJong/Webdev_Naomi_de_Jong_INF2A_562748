<?php include __DIR__ . '/../header.php'; ?>

    <div class="container">
        <h1 class="magic d-flex justify-content-center m-3">Welcome <?php echo $_SESSION['user']; ?>!</h1>
        <?php if (empty($decks)): ?>
            <div class="border border-gray-200 text-white m-4 p-5 rounded text-center">
                You have no decks saved. Add a deck by clicking the button below.
            </div>
        <?php else: ?>
            <div class="row border border-gray-200 text-white m-4 p-3 rounded d-flex justify-content-center">
                <?php foreach ($decks as $deck): ?>
                    <div class="col-md-3 mb-3 ">
                        <div class="card">
                            <img src="<?php echo $deck['thumbnail']; ?>" class="card-img-top" alt="Deck Thumbnail">
                            <div class="card-body">
                                <h5 class="card-title d-flex justify-content-center"><?php echo $deck['name']; ?></h5>
                                <a href="/deck?id=<?php echo $deck['id']; ?>" class="btn btn-primary d-flex justify-content-center">View Deck</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="text-center">
            <a class="btn btn-primary m-3" href="/newdeck">Add Deck +</a>
        </div>
    </div>

<?php include __DIR__ . '/../footer.php';