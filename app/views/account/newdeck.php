<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow border border-gray-200 rounded">
                <div class="card-header border border-gray-200 rounded text-light">
                    <h3>Create New Deck</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Deck Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="decklist">Decklist:</label>
                            <textarea class="form-control" id="decklist" name="decklist" rows="10" placeholder="Make sure to put the amount in front of every card:&#10;1 Sakura-Tribe Elder&#10;3 Forest" ></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-8">
                                <label for="cardname">Deck Thumbnail:</label>
                                <input type="text" class="form-control" id="cardname" name="cardname" placeholder="Ex.: Prosper, Tome-Bound"required>
                            </div>
                            <div class="col p-2 d-flex justify-content-center">
                                <img id="cardpreview" src="/images/card.jpg"">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" name="submit" class="btn btn-primary">Create Deck</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- add js -->
<script src="/js/thumbnail.js"></script>
<?php include __DIR__ . '/../footer.php'; ?>
