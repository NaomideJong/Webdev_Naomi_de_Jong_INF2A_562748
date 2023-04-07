<?php include __DIR__ . '/../header.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form>
                    <div class="form-group">
                        <label for="cardName">Card Name:</label>
                        <input type="text" class="form-control" id="cardName" name="cardName" required>
                    </div>
                    <div class="form-group">
                        <label for="cardAmount">Amount:</label>
                        <input type="number" class="form-control" id="cardAmount" name="cardAmount" required>
                    </div>
                    <div class="form-group">
                        <label for="cardPrice">Price:</label>
                        <input type="number" class="form-control" id="cardPrice" name="cardPrice" required>
                    </div>
                    <div class="form-group">
                        <label for="cardPreview">Card Preview:</label>
                        <img id="cardpreview" src="/images/card.jpg"">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-primary" id="addCardBtn">Add Card</button>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php foreach ($cards as $card): ?>
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $card->name; ?></h5>
                                    <p class="card-text"><?php echo $card->amount; ?></p>
                                    <p class="card-text"><?php echo '$' . $card->price; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="btn btn-sm btn-danger" id="deleteCardBtn">Delete</button>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="<?php echo $card->id; ?>" id="deleteCheckbox">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-danger" id="deleteSelectedBtn">Delete Selected Cards</button>
                </div>
            </div>
        </div>
    </div>

    <!-- add js -->
    <script src="/js/thumbnail.js"></script>


    <!--    <table class="table table-striped">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th><input type="checkbox" id="select-all"></th>-->
<!--            <th>Amount</th>-->
<!--            <th>Name</th>-->
<!--            <th></th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php //foreach ($cards as $card): ?>
<!--            <tr>-->
<!--                <td><input type="checkbox" class="select-card"></td>-->
<!--                <td><span class="card-amount">--><?php //echo $card['amount']; ?><!--</span></td>-->
<!--                <td>--><?php //echo $card['name']; ?><!--</td>-->
<!--                <td>-->
<!--                    <button type="button" class="btn btn-sm btn-primary btn-update-card" data-card-id="--><?php //echo $card['id']; ?><!--">+</button>-->
<!--                    <button type="button" class="btn btn-sm btn-primary btn-update-card" data-card-id="--><?php //echo $card['id']; ?><!--">-</button>-->
<!--                </td>-->
<!--            </tr>-->
<!--        --><?php //endforeach; ?>
<!--        </tbody>-->
<!--    </table>-->
<!--    <button type="button" class="btn btn-danger" id="btn-delete-cards">Delete Selected Cards</button>-->
<!---->
<!--    <script>-->
<!--        // Select all checkbox-->
<!--        $('#select-all').on('change', function() {-->
<!--            $('.select-card').prop('checked', this.checked);-->
<!--        });-->
<!---->
<!--        // Update card buttons-->
<!--        $('.btn-update-card').on('click', function() {-->
<!--            var cardId = $(this).data('card-id');-->
<!--            var amountSpan = $(this).parent().siblings('.card-amount');-->
<!--            var amount = parseInt(amountSpan.text());-->
<!---->
<!--            if ($(this).text() == '+') {-->
<!--                amount += 1;-->
<!--            } else {-->
<!--                amount -= 1;-->
<!--            }-->
<!---->
<!--            if (amount < 1) {-->
<!--                amount = 1;-->
<!--            }-->
<!---->
<!--            $.ajax({-->
<!--                url: '/update-card',-->
<!--                method: 'POST',-->
<!--                data: {-->
<!--                    card_id: cardId,-->
<!--                    amount: amount-->
<!--                },-->
<!--                success: function(response) {-->
<!--                    amountSpan.text(amount);-->
<!--                },-->
<!--                error: function() {-->
<!--                    alert('Error updating card.');-->
<!--                }-->
<!--            });-->
<!--        });-->
<!---->
<!--        // Delete cards button-->
<!--        $('#btn-delete-cards').on('click', function() {-->
<!--            var cardIds = [];-->
<!---->
<!--            $('.select-card:checked').each(function() {-->
<!--                cardIds.push($(this).closest('tr').find('.btn-update-card').data('card-id'));-->
<!--            });-->
<!---->
<!--            if (cardIds.length == 0) {-->
<!--                alert('Please select at least one card to delete.');-->
<!--                return;-->
<!--            }-->
<!---->
<!--            if (!confirm('Are you sure you want to delete selected cards?')) {-->
<!--                return;-->
<!--            }-->
<!---->
<!--            $.ajax({-->
<!--                url: '/delete-cards',-->
<!--                method: 'POST',-->
<!--                data: {-->
<!--                    card_ids: cardIds-->
<!--                },-->
<!--                success: function(response) {-->
<!--                    location.reload();-->
<!--                },-->
<!--                error: function() {-->
<!--                    alert('Error deleting cards.');-->
<!--                }-->
<!--            });-->
<!--        });-->
<!--    </script>-->


<?php include __DIR__ . '/../footer.php';
