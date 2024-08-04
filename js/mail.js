"use strict";

const mailBodyForm = document.querySelector('php-email-body-form');

console.log({mailBodyForm});

mailBodyForm.addEventListener('submit', e => {
  e.preventDefault();
  e.stopPropagation();
  alert('Сообщение отправлено');
  const name = mailBodyForm.querySelector('#name').value;
  const email = document.getElementById('email').value;
  const message = document.getElementById('message').value;
  const body = `Name: ${name}\nEmail: ${email}\nMessage: ${message}`;
  // const url = `https://api.telegram.org/bot${token}/sendMessage?chat_id=${chatId}&text=${body}`;
  const url = '../mail.php';

  async function sendMessage() {
     const response = await fetch(url, {
    method: 'POST',
    body: body
  })
  // .then(() => {
  //   alert('Сообщение отправлено');
  //   document.getElementById('name').value = '';
  //   document.getElementById('email').value = '';
  //   document.getElementById('message').value = '';
  // }).catch(() => {
  //   alert('При отправке произошла ошибка');
  // });

  }
  sendMessage();
})
