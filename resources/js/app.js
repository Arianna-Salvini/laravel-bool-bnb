import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);





let address = document.getElementById('address');

let street_number = document.getElementById('street_number');
let zip_code = document.getElementById('zip_code');
let city = document.getElementById('city');
let country_code = document.getElementById('country_code');
console.log(address, street_number);

let addressList = document.getElementById('address-list');
let api_key = 'TubXmNyzFnYoGMpgu1RAnYEHnVO24pfI';
/* 
let inputs = [];
inputs.push(address, street_number, zip_code, city, country_code);
console.log(inputs);

inputs.forEach((input, index) => {
    //console.log(input);
    input.addEventListener('input', function () {
        let inputValue = this.value.replace(' ', '%20');

        let url = `https://api.tomtom.com/search/2/search/${inputValue[1]}%20${inputValue[2]}%20${inputValue[3]}%20${inputValue[4]}?countrySet=${inputValue[5]}.json?view=Unified&relatedPois=off&key=${api_key}`;

        async function getResults(url) {
            let result = await fetch(url);
            return result.json();
        }

        getResults(url).then(response => {
            console.log(response);
            addressList.innerHTML = '';
            for (let i = 0; i < 5; i++) {
                let resultAddress = document.createElement('li');
                resultAddress.innerHTML = response.results[i].address.freeformAddress
                addressList.appendChild(resultAddress);
            }
        });
    })
}) */

address.addEventListener('input', function () {
    console.log(this.value);
    let addressValue = this.value.replace(' ', '%20');


    let url = `https://api.tomtom.com/search/2/search/${addressValue}.json?view=Unified&relatedPois=off&key=${api_key}`;

    async function getResults(url) {
        let result = await fetch(url);
        return result.json();
    }

    getResults(url).then(response => {
        console.log(response);
        addressList.innerHTML = '';
        for (let i = 0; i < 5; i++) {
            let resultAddress = document.createElement('li');

            resultAddress.innerHTML = response.results[i].address.freeformAddress

            addressList.appendChild(resultAddress);

            resultAddress.addEventListener('click', function () {
                //console.log(this.innerHTML);
                //console.log(address.value);
                //console.log(response.results[i].address.streetName);

                address.value = response.results[i].address.streetName;
                street_number.value = response.results[i].address.streetNumber;
                zip_code.value = response.results[i].address.postalCode;
                city.value = response.results[i].address.municipality;
                country_code.value = response.results[i].address.countryCode;


                addressList.innerHTML = '';
            })
        }
    });

})
