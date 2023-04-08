$(document).ready(function() {
    // add card button click handler
    $('#addCardBtn').click(function() {
        // get form data
        var deckId = $('#deckId').val();
        var cardName = $('#cardname').val();
        var cardAmount = $('#cardAmount').val();

        // make AJAX request to add card
        $.ajax({
            url: '/deck?id=' + deckId,
            type: 'POST',
            data: {
                deckId: deckId,
                cardName: cardName,
                cardAmount: cardAmount
            },
            success: function(response) {
                // reload the card list
                location.reload();
            },
            error: function() {
                alert('Error adding card');
            }
        });
    });

    // update card amount click handler
    $('body').on('click', '.updateCardAmountBtn', function() {
        // get deck ID, card name, card ID, and new amount
        var deckId = $(this).closest('.deck').data('deckid');
        var cardName = $(this).closest('.card').find('.cardName').text();
        var newAmount = $(this).siblings('.cardAmountInput').val();

        // make AJAX request to update card amount
        $.ajax({
            url: '/cards/updateAmount',
            type: 'POST',
            data: {
                deckId: deckId,
                cardName: cardName,
                newAmount: newAmount
            },
            success: function(response) {
                // reload the card list
                location.reload();
            },
            error: function() {
                alert('Error updating card amount');
            }
        });
    });


    // delete card click handler
    $('body').on('click', '.deleteCardBtn', function() {
        // get card ID
        var cardId = $(this).data('cardid');

        // make AJAX request to delete card
        $.ajax({
            url: '/cards/delete',
            type: 'POST',
            data: {
                cardId: cardId
            },
            success: function(response) {
                // reload the card list
                location.reload();
            },
            error: function() {
                alert('Error deleting card');
            }
        });
    });

    // delete selected cards click handler
    $('#deleteSelectedBtn').click(function() {
        // get selected card IDs
        var selectedCards = $('.deleteCheckbox:checked').map(function() {
            return $(this).val();
        }).get();

        // make AJAX request to delete selected cards
        $.ajax({
            url: '/cards/deleteSelected',
            type: 'POST',
            data: {
                cardIds: selectedCards
            },
            success: function(response) {
                // reload the card list
                location.reload();
            },
            error: function() {
                alert('Error deleting cards');
            }
        });
    });
});

//confirm delete modal
$('#confirmDeleteBtn').on('click', function() {
    var ids = [];
    $('.delete-checkbox:checked').each(function() {
        ids.push($(this).val());
    });
    $.ajax({
        url: '/delete-cards.php',
        type: 'POST',
        data: {ids: ids},
        success: function(response) {
            if (response == 'success') {
                location.reload();
            } else {
                alert('Failed to delete cards.');
            }
        }
    });
});
