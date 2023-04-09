<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-white p-5">
            <h3>Deck Name: <?= $deckName ?></h3>
        </div>
        <div class="col-md-6 text-white p-5">
            <h3 id="totalPrice">Total Price: € <?= $totalPrice ?></h3>
        </div>
    <div class="row">
        <div class="col-md-6 text-white p-5">
            <h3>Add Card</h3>
            <form method="post">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <label for="cardName" class="text-white">Card Name:</label>
                            <input type="text" class="form-control" id="cardname" name="cardName" required>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="cardAmount" class="text-white">Amount:</label>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary minus-btn" data-target="#cardAmount">-</button>
                                <input type="number" class="form-control text-center" id="cardAmount" name="cardAmount" required min="1" value="1" data-value="1">
                                <button type="button" class="btn btn-outline-secondary plus-btn" data-target="#cardAmount">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="form-group position-relative">
                            <input type="hidden" id="deckId" name="deckId" value="<?php echo $this->deckId;?>">
                            <label for="cardPreview" class="text-white">Card Preview:</label>
                            <img id="cardpreview" src="/images/card.jpg">
                            <img src=" " id="hoverCardPreview" alt="Card Preview">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group d-flex justify-content-end">
                            <button type="submit" name="addCard" class="btn btn-primary">Add Card</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--button to delete the whole deck-->
            <div class="d-flex justify-content-start mt-5">
                <form method="POST">
                    <button class="btn btn-danger" type="submit" name="deleteDeck">Delete Deck</button>
                </form>
            </div>
        </div>
        <div class="col-md-6 text-white pt-5">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-white">Card List</h3>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-danger m-3" id="deleteButton">Delete Selected Cards</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cards as $card): ?>
                        <tr class="card-item">
                            <td class="card-name"><?php echo $card->name; ?></td>
                            <td class="card-price"> <?php echo '€ ' . ($card->price * $card->amount); ?></td>
                            <td>
                                <div class="input-group">
                                    <button type="button" class="btn btn-outline-secondary" id="minus-button">-</button>
                                    <input id="card-amount-<?php echo $card->name; ?>" type="number" class="form-control card-amount-input text-center" value="<?php echo $card->amount; ?>" min="1" readonly>
                                    <button type="button" class="btn btn-outline-secondary" id="plus-button">+</button>
                                </div>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input delete-checkbox" type="checkbox" name="cardsToDelete[]" value="<?php echo $card->name; ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td id="totalPrice">Total Price: <?php echo '€' . $totalPrice; ?></td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


    <!-- add js -->
<script src="/js/cardupdate.js"></script>
<script src="/js/thumbnail.js"></script>


<?php include __DIR__ . '/../footer.php'; ?>