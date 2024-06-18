// lets take all the variables from the registration page

let submit = document.getElementById('submit')

let birthDate = document.getElementById('birth_date');

const currentDate = new Date().toISOString().split('T')[0];

//console.log(currentDate)
birthDate.setAttribute('max', currentDate);

/* get all input elements from the page */
let userName = document.getElementById('name');
let lastName = document.getElementById('lastname');
let email = document.getElementById('email');
let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');
let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,20}$/;

let inputElements = [userName, lastName, email, birthDate, password, passwordConfirm];
//console.log(inputElements);



/* for each input element, check if the input is empty */
inputElements.forEach(inputElement => {
    inputElement.addEventListener('input', function () {
        /* if input is empty, print an error message and add is-invalid class */
        if (inputElement.value.trim() === '') {
            inputElement.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">You must fill the field</div>');
            inputElement.classList.add("is-invalid");

        }
        else {
            /* remove prev error messages, remove is-invalid class and add is-valid class */
            removeErrorMessages();
            inputElement.classList.remove("is-invalid")
            inputElement.classList.add("is-valid");

            /* if inputEmail is email, check match with pattern */
            if (inputElement == email && !emailPattern.test(email.value)) {
                inputElement.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Invalid email address</div>');
                inputElement.classList.add("is-invalid");

            }

            /* if inputElement is birthDate */
            if (inputElement == birthDate) {
                let today = new Date();
                let birthDateValue = new Date(birthDate.value);
                let age = today.getFullYear() - birthDateValue.getFullYear();

                /* check if your birthday is after today, your age will decrement since you're in your 18th year of life but you're still 17 (ex) */
                if (today < new Date(today.getFullYear(), birthDateValue.getMonth(), birthDateValue.getDate())) {
                    age--;
                }
                /* if age < 18 return error */
                if (age < 18) {
                    birthDate.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">You must be at least 18 years old</div>');
                    inputElement.classList.add("is-invalid");
                }
            }

            /* if inputElement is passwordConfirm and password doesn't match passwordConfirm */
            if (inputElement == passwordConfirm && password.value !== passwordConfirm.value) {
                inputElement.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Password doesn\'t match</div>');
                inputElement.classList.remove("is-valid");
                inputElement.classList.add("is-invalid");
            }

            /* if inputElement is password */
            if (inputElement == password) {
                /* if password doesn't match passworwPattern return error  */
                if (inputElement.value.match(passwordPattern) == null) {
                    inputElement.insertAdjacentHTML("afterend", '<div class="error-message" style="color: red;">Password must be at least 8 characters and must contain at least one uppercase letter, one digit and one special character</div>');
                    inputElement.classList.add("is-invalid");

                }
                else {
                    removeErrorMessages();
                    inputElement.classList.remove("is-invalid");
                    inputElement.classList.add("is-valid");
                }
            }


        }

        CheckCorrectInputs();
    })
});


function removeErrorMessages() {
    let errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function (errorMessage) {
        errorMessage.remove(); // remove the nod if exist so we haven't too many messages
    });
}

function CheckCorrectInputs() {
    let error = document.getElementsByClassName('is-valid');
    if (error.length !== inputElements.length) {
        submit.classList.remove('text-success');
        submit.classList.add('text-danger');
    }
    else {
        submit.classList.remove('text-danger');
        submit.classList.add('text-success');
    }
}