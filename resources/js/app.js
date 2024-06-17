import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);
import axios from 'axios';





let address = document.getElementById('address');
let street_number = document.getElementById('street_number');
console.log(address, street_number);
let addressList = document.getElementById('address-list');
let api_key = 'TubXmNyzFnYoGMpgu1RAnYEHnVO24pfI';

address.addEventListener('input', function () {
    console.log(this.value);
    let addressValue = this.value.replace(' ', '%20');


    let url = `https://api.tomtom.com/search/2/search/${addressValue}.json?view=Unified&relatedPois=off&key=${api_key}`;
    /* fetch(url).then(response => {
        console.log(response);
    })
        .catch(err => console.log(err)) */

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
