const deleteButton = document.getElementById('deleteButton');
const checkboxes = document.querySelectorAll('.delete-checkbox');
const plusButtons = document.querySelectorAll('#plus-button');
const minusButtons = document.querySelectorAll('#minus-button');
const amountOfCardsList = document.querySelectorAll('.card-amount-input');

deleteButton.addEventListener('click', () => {
    const checkedBoxes = document.querySelectorAll('.delete-checkbox:checked');

    if (checkedBoxes.length > 0) {
        removeCards(checkedBoxes);
    }
});

//remove cards from database and refresh the list without reloading the page
async function removeCards(cardsToDelete) {
    const cardNames = Array.from(cardsToDelete).map(card => card.value);
    let deckId = document.getElementById('deckId').value;

    // do post request to remove cards
    const response = await fetch('/deck/removeCards', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            cardNames: cardNames,
            deckId: deckId
        })
    });

    // if response is ok, reload the list without reloading the page
    if (response.ok) {
        const totalPrice = document.getElementById('totalPrice');
        const cardPrices = document.querySelectorAll('.card-price');
        let totalPriceValue = totalPrice.innerText;
        //get price of all deleted cards
        cardNames.forEach(cardName => {
            totalPriceValue -= parseInt(document.querySelector(`.card-price[data-card-name="${cardName}"]`));
        });

        totalPrice.innerText = totalPriceValue;

        cardsToDelete.forEach(card => {
            card.closest('tr').remove();
        });
    }
}

//button listners for the plus and minus buttons
plusButtons.forEach((button, index) => {
    button.addEventListener('click', async () => {
        const cardName = button.closest('.card-item').querySelector('.card-name').textContent;
        let newAmount = parseInt(amountOfCardsList[index].value) + 1;
        await updateCardAmount(cardName, newAmount);
        amountOfCardsList[index].value = newAmount;
    });
});
minusButtons.forEach((button, index) => {
    button.addEventListener('click', async () => {
        const cardName = button.closest('.card-item').querySelector('.card-name').textContent;
        if(amountOfCardsList[index].value <= 1) return;
        let newAmount = parseInt(amountOfCardsList[index].value) - 1;
        await updateCardAmount(cardName, newAmount);
        amountOfCardsList[index].value = newAmount;
    });
});


//update the amount of a card without reloading the page
async function updateCardAmount(cardName, newAmount) {
    const deckId = document.getElementById('deckId').value;

    if (isNaN(newAmount) || newAmount < 1) {
        input.value = 1;
        return;
    }

    try {
        const response = await fetch('/deck/updateAmount', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                cardName: cardName,
                newAmount: newAmount,
                deckId: deckId
            })
        });

        const data = await response.json();

        if (response.ok) {
            // update the amount displayed on the page
            input.value = data.newAmount;
        } else {
            // reset the amount to the previous value
            input.value = data.previousAmount;
        }
    } catch (error) {
        console.error(error);
    }
}

//change the quantity of a card for the new card
$(document).on('click', '.plus-btn, .minus-btn', function(e) {
    const target = $(this).data('target');
    const input = $(target);
    const value = parseInt(input.val()) || 0;
    const delta = $(this).hasClass('plus-btn') ? 1 : -1;
    input.val(Math.max(value + delta, 1));
});

