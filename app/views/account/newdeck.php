<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card shadow border border-gray-200 rounded">
                <div class="card-header border border-gray-200 rounded text-light">
                    <h3>Create New Deck</h3>
                </div>
                <div class="card-body">
                    <form action="/decks" method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="decklist">Decklist:</label>
                            <textarea class="form-control" id="decklist" name="decklist" rows="10"></textarea>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">Create Deck</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
