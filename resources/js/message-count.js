let value = document.getElementById('count');
let interval = 1500;
let startValue = 0;
let endValue = parseInt(value.getAttribute("data-val"));
let duration = Math.floor(interval / endValue);
let slowDownDuration = 500;


function updateValue() {
    startValue += 1;
    value.textContent = startValue;
    if (startValue == endValue) {
        clearInterval(counter);
    } else if (endValue - startValue <= 5) {
        clearInterval(counter);
        counter = setInterval(updateValue, slowDownDuration);
    }
}

let counter = setInterval(updateValue, duration);