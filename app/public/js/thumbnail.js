// This script is used to retrieve the image URL of a card from the Scryfall API and display it in the card preview box.
$(document).ready(function() {
    $('#cardname').on('input', function() {
        var cardName = $(this).val();
        $.ajax({
            url: 'https://api.scryfall.com/cards/named?fuzzy=' + cardName,
            type: 'GET',
            success: function(data) {
                $('#cardpreview').attr('src', data.image_uris.normal).show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                //set the image to a default image
                $('#cardpreview').attr('src', '/../images/card.jpg').show();
            }
        });
    });
});