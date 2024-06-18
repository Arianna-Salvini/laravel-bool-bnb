let street_number = document.getElementById('street_number');


function validatedInput(input) {
    // check that the string contains letters, numbers, and only the '/' character
    const regex = /^[a-zA-Z0-9/]+$/;
    return regex.test(input);
}

street_number.addEventListener('input', function () {
    let inputValue = street_number.value;
    let isValid = validatedInput(inputValue);

    if (isValid) {
        street_number.classList.remove('is-invalid');
        street_number.classList.add('is-valid');
    } else {
        event.preventDefault(); // interrompe l invio del form
        street_number.classList.remove('is-valid');
        street_number.classList.add('is-invalid');
    }
});
