"use strict";

const mailBodyForm = document.querySelector('form.php-email-body-form');
const clientName   = mailBodyForm.querySelector('#client-name')


// add mask to tel input and validate form
const im = new Inputmask("+7(999) 999-99-99")
im.mask(mailBodyForm.querySelector('#client-tel'));


const validation = new JustValidate('#email-body-form')

validation
    .addField('#client-name', [
        {
            rule:         "required",
            errorMessage: "Поле обязательно для заполнения",
        },
        {
            rule:         "minLength",
            value:        2,
            errorMessage: "Имя слишком короткое",
        },
    ])
    .addField('#client-tel', [
        {
            rule:         "required",
            errorMessage: "Поле обязательно для заполнения",
        },
        {
            rule:         "minLength",
            value:        11,
            errorMessage: "Номер телефона указан неверно",
        },
    ]).onSuccess(async function () {
    const loader         = mailBodyForm.querySelector('.body-mail-form-loading')
    loader.style.display = 'block';
    const data             = {
        name:      clientName.value,
        tel:       mailBodyForm.querySelector('#client-tel').value,
        promoCode: mailBodyForm.querySelector('#promo_id').value,
        message:   mailBodyForm.querySelector('#message').value,
        subject:   "Сообщение с сайта www.motodc.ru"
    }

    const response = await fetch("forms/contact.php", {
        method:  "POST",
        body:    JSON.stringify(data),
        headers: {
            "Content-Type": "application/json; charset=UTF-8"
        }
    })

    const result = await response.text()

    const messageSentBlock         = mailBodyForm.querySelector(".sent-message")
    messageSentBlock.textContent = result
    messageSentBlock.style.display = 'block';
    loader.style.display           = 'none';

    clientName.value=''
    mailBodyForm.querySelector('#client-tel').value=''
    mailBodyForm.querySelector('#promo_id').value=''
    mailBodyForm.querySelector('#message').value=''
    setTimeout(() => {
        messageSentBlock.style.display = 'none';
    }, 3000)
})



