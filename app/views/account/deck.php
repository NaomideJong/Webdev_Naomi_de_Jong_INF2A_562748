<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-white p-5">
            <h3>Add Card</h3>
            <form>
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
                                <button type="button" class="btn btn-outline-secondary minus-btn">-</button>
                                <input type="number" class="form-control text-center" id="cardAmount" name="cardAmount" required min="1" value="1">
                                <button type="button" class="btn btn-outline-secondary plus-btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="form-group position-relative">
                            <input type="hidden" id="deckId" name="deckId" value="<?php echo $deckId; ?>">
                            <label for="cardPreview" class="text-white">Card Preview:</label>
                            <img id="cardpreview" src="/images/card.jpg">
                            <img src="/images/cards.jpg" id="hoverCardPreview" alt="Card Preview">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="addCardBtn">Add Card</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <div class="col-md-6 text-white pt-5">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-white">Card List</h3>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-danger m-3" data-toggle="modal" data-target="#deleteModal">Delete Selected Cards</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-white">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price per card</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cards as $card): ?>
                    <tr class="card-item">
                        <td class="card-name"><?php echo $card->name; ?></td>
                        <td><?php echo '€' . ($card->price * $card->amount); ?></td>
                        <td>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary minus-btn">-</button>
                                <input type="number" class="form-control card-amount-input text-center" value="<?php echo $card->amount; ?>" min="1" readonly>
                                <button type="button" class="btn btn-outline-secondary plus-btn">+</button>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input delete-checkbox" type="checkbox" value="<?php echo $card->id; ?>">
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td>Total Price: <?php echo '€' . $totalPrice; ?></td>
                    <td></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



    <!-- add js -->
<script src="/js/cardupdate.js"></script>
<script src="/js/thumbnail.js"></script>

    <!-- Card preview modal -->
    <div class="modal fade" id="card-preview-modal" tabindex="-1" role="dialog" aria-labelledby="card-preview-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="card-preview-modal-label"><span id="card-preview-name"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img id="card-preview-img" class="img-fluid" src="">
                        </div>
                        <div class="col-md-6">
                            <p id="card-preview-description"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm delete modal -->
<div class="modal fade" id="deleteSelectedModal" tabindex="-1" role="dialog" aria-labelledby="deleteSelectedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSelectedModalLabel">Delete Selected Cards</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the selected cards?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>