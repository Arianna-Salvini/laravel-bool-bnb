let value = document.getElementById('count');
let interval = 1500;
let startValue = 0;
let endValue = parseInt(value.getAttribute("data-val"));
let duration = endValue > 0 ? Math.floor(interval / endValue) : interval;
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

// Check if endValue is greater than 0 before starting the interval
let counter;
if (endValue > 0) {
    counter = setInterval(updateValue, duration);
} else {
    value.textContent = startValue;
}