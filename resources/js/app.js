import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);




/* get all address inputs from document */
let address = document.getElementById('address');
let street_number = document.getElementById('street_number');
let zip_code = document.getElementById('zip_code');
let city = document.getElementById('city');
let country_code = document.getElementById('country_code');
//console.log(address, street_number);

/* get list element from document (this is where I'll show address suggestions) */
let addressList = document.getElementById('address-list');

/* save api_key */
let api_key = 'TubXmNyzFnYoGMpgu1RAnYEHnVO24pfI';

/* add event listener on address input. Event to listen for: input (keyup) */
address.addEventListener('input', function () {
    //console.log(this.value);

    /* replace spaces with %20 */
    let addressValue = this.value.replace(' ', '%20');

    /* create url using search api */
    let url = `https://api.tomtom.com/search/2/search/${addressValue}.json?view=Unified&relatedPois=off&key=${api_key}`;

    /* use async function to get result: the function returns a promise resolved with result data transformed in json */
    async function getResults(url) {
        let result = await fetch(url);
        return result.json();
    }

    /* after the promise is resolved, get json result */
    getResults(url).then(response => {
        console.log(response);

        /* empty list */
        addressList.innerHTML = '';

        /* show 5 suggestions. Create a list item for each loop */
        for (let i = 0; i < 5; i++) {
            let resultAddress = document.createElement('li');

            /* write response full address into list item */
            resultAddress.innerHTML = response.results[i].address.freeformAddress

            /* append list item to list */
            addressList.appendChild(resultAddress);

            /* add event listener to each suggestion. Event to listen for: click */
            resultAddress.addEventListener('click', function () {
                //console.log(this.innerHTML);
                //console.log(address.value);
                //console.log(response.results[i].address.streetName);

                /* when I click, I get all fields autocomplete with response data */
                address.value = response.results[i].address.streetName;
                street_number.value = response.results[i].address.streetNumber;
                zip_code.value = response.results[i].address.postalCode;
                city.value = response.results[i].address.municipality;
                country_code.value = response.results[i].address.countryCode;

                /* when I select a suggestion, the other suggestions disappear */
                addressList.innerHTML = '';
            })
        }
    });

})
