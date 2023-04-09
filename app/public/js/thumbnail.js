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

//Show card preview on hover
$(document).ready(function() {
    // event delegation to attach hover function to parent element
    $('.table-responsive').on('mouseenter', 'td.card-name', function() {
        var cardName = $(this).text().trim();
        $.ajax({
            url: 'https://api.scryfall.com/cards/named?fuzzy=' + cardName,
            type: 'GET',
            success: function(data) {
                $('#hoverCardPreview').attr('src', data.image_uris.normal).show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // set the image to a default image
                $('#hoverCardPreview').attr('src', '/../images/card.jpg').show();
            }
        });
    }).on('mouseleave', 'td.card-name', function() {
        // hide the image on mouse leave
        $('#hoverCardPreview').hide();
    });
});

const form = document.querySelector('#newDeckForm');

form.addEventListener('submit', (event) => {
    event.preventDefault(); // prevent the form from submitting

    // show the "please wait" alert
    alert('Please wait, this will only take a moment.');

    // submit the form after a short delay
    setTimeout(() => {
        form.submit();
    }, 1000); // delay for 1 second (1000 milliseconds)
});



