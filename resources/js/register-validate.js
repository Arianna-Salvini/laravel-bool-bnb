// lets take all the variables from the registration page

let submit = document.getElementById('submit')

submit.addEventListener('click', click)
let birthDate = document.getElementById('birth_date');

const today = new Date().toISOString().split('T')[0]

console.log(today)

birthDate.setAttribute('max', today);

function click(event) {
    // remove error message avoid to many messages
    removeErrorMessages();

    let name = document.getElementById('name');
    let lastName = document.getElementById('lastname');
    let email = document.getElementById('email');
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let password = document.getElementById('password');
    let passwordConfirm = document.getElementById('password-confirm');

    // age section
    let today = new Date();
    let birthDateValue = new Date(birthDate.value);
    let age = today.getFullYear() - birthDateValue.getFullYear();

    //condition section

    if (name.value.trim() === '') {
        name.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Devi inserire un valore, non puoi lasciare il campo vuoto</div>');
        name.classList.add("is-invalid")
        event.preventDefault();
    }

    if (lastName.value.trim() === '') {
        lastName.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Devi inserire un valore, non puoi lasciare il campo vuoto</div>');
        lastName.classList.add("is-invalid")
        event.preventDefault();
    }

    if (email.value.trim() === '') {
        email.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Devi inserire un valore, non puoi lasciare il campo vuoto</div>');
        email.classList.add("is-invalid")
        event.preventDefault();
    } else if (!emailPattern.test(email.value)) {
        email.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Devi inserire un indirizzo email valido</div>');
        email.classList.add("is-invalid")
        event.preventDefault();
    }

    if (password.value.trim() === '' || passwordConfirm.value.trim() === '') {
        password.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Devi inserire un valore, non puoi lasciare il campo vuoto</div>');
        password.classList.add("is-invalid")
        event.preventDefault();
    } else if (password.value !== passwordConfirm.value) {
        password.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Le password devono corrispondere</div>');
        password.classList.add("is-invalid")
        passwordConfirm.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Le password devono corrispondere</div>');
        passwordConfirm.classList.add("is-invalid")
        event.preventDefault();
    } else if (password.value.length < 8) {
        password.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Le password devono avere una lunghezza di almeno 8 caratteri</div>');
        password.classList.add("is-invalid")
        passwordConfirm.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Le password devono avere una lunghezza di almeno 8 caratteri</div>');
        passwordConfirm.classList.add("is-invalid")
        event.preventDefault();
    }

    // age condition

    if (today < new Date(today.getFullYear(), birthDateValue.getMonth(), birthDateValue.getDate())) {
        age--;
    }

    if (age < 18) {
        birthDate.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Non si possono registrare i minorenni</div>');
        event.preventDefault();
    }

}

function removeErrorMessages() {
    let errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function (errorMessage) {
        errorMessage.remove(); // remove the nod if exist so we haven't too many messages
    });
}