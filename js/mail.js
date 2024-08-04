"use strict";

const mailBodyForm = document.querySelector('form.php-email-body-form');
const clientName = mailBodyForm.querySelector('#client-name')

// add mask to tel input and validate form
const im = new Inputmask("+7(999) 999-99-99")
im.mask(mailBodyForm.querySelector('#client-tel'));


const validation = new JustValidate('#email-body-form')

validation
  .addField('#client-name', [
    {
      rule: "required",
      errorMessage: "Поле обязательно для заполнения",
    },
    {
      rule: "minLength",
      value: 2,
      errorMessage: "Имя слишком короткое",
    },
  ])
  .addField('#client-tel', [
    {
      rule: "required",
      errorMessage: "Поле обязательно для заполнения",
    },
    {
      rule: "minLength",
      value: 11,
      errorMessage: "Номер телефона указан неверно",
    },
  ]).onSuccess(async function () {
    const loader = mailBodyForm.querySelector('.body-mail-form-loading')
    loader.style.display = 'block';
  let data = {
        name: clientName.value,
        tel:mailBodyForm.querySelector('#client-tel').value,
        promoCode:mailBodyForm.querySelector('#promo_id').value,
        message:mailBodyForm.querySelector('#message').value,
  }

  let response = await fetch("forms/contact.php", {
    method: "POST",
    body: JSON.stringify(data),
    headers: {
      "Content-Type": "application/json; charset=UTF-8"
    }
  })

  const result = await response.text()
  console.log({result})
  const messageSentBlock = mailBodyForm.querySelector(".mailBodyForm")
  messageSentBlock.style.display = 'block';
  setTimeout(() => {
    messageSentBlock.style.display = 'none';
   }, 3000)
})








// add action to button form

// mailBodyForm.querySelector('.email-body-form-button').addEventListener('click', e => {
// mailBodyForm.addEventListener('click', e => {
//   e.preventDefault();
//   e.stopPropagation();
//   const loader = mailBodyForm.querySelector('.body-mail-form-loading')
//   loader.style.display = 'block';
//   setTimeout(() => {
//     loader.style.display = 'none';
//    }, 3000)


//     console.log({mailBodyFormClientData});
// })

const mailBodyContaier = document.querySelector('.email-body-form-container')
document.querySelector('.post-form-activate-icon').addEventListener('click', e => {
  e.preventDefault();
  e.stopPropagation();
  mailBodyContaier.style.display = 'flex';
})
document.querySelector('.post-form-activate-label').addEventListener('click', e => {
  e.preventDefault();
  e.stopPropagation();
  mailBodyContaier.style.display = 'none';
})
