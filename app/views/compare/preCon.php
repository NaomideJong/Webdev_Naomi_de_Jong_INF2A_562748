<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 text-white pt-5">
            <h3 class="text-white mb-3"><?php echo $preCon[0]['pre_con_name']; ?></h3>
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($preConCards as $preConCard): ?>
                        <tr>
                            <td><?php echo $preConCard['card_name']; ?></td>
                            <td class="text-center"> <?php echo $preConCard['amount']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td class="text-center" colspan="2">Total Price: <?php echo '€ ' . $preCon[0]['price']; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 text-white pt-5">
            <h3 class="text-white mb-3">Your Deck</h3>
            <?php if (count($userDecks) > 0): ?>
                <form method="POST">
                    <div class="row">
                        <div class="col-md-10">
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg" name="deck_id">
                                <?php foreach ($userDecks as $userDeck): ?>
                                    <?php $selected = ($userDeck['id'] == $deckId) ? 'selected' : ''; ?>
                                    <option value="<?php echo $userDeck['id']; ?>" <?php echo $selected; ?>><?php echo $userDeck['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" name="compare" class="btn btn-primary">Compare</button>
                        </div>
                    </div>
                </form>
            <?php else: ?>
                <p>You have no decks</p>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Amount</th>
                    </tr>
                    </thead>
                    <tbody class="user-deck-table">
                    <?php if (isset($userDeckCards)): ?>
                        <?php foreach ($userDeckCards as $userDeckCard): ?>
                            <tr>
                                <td><?php echo $userDeckCard->name; ?></td>
                                <td class="text-center"> <?php echo $userDeckCard->amount; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td>Total Price: <?php echo '€ ' . $userDeckTotal; ?></td>
                            <td></td>
                        </tr>
                        </tfoot>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
