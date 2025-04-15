"use strict";

console.log('testing main product js');

const addProduct = (event, this) => {

    event.preventDefault();
    let formData = new FormData($('#' + $(this).attr('form'))[0]);


}