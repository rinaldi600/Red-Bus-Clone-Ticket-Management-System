const btnSee = document.querySelectorAll('.btn-see');
const btnPayment = document.querySelectorAll('.link p');
const completePaymentComponent = document.querySelector('.complete-payment');
const incompletePaymentComponent = document.querySelector('.incomplete-payment');
const btnChecklistOrder = document.querySelectorAll('.checklist-order');
const dateTime = document.querySelector('.date-time');
const btnOrder = document.querySelector('.button-order .btn');
const btnDeleteOrder = document.querySelectorAll('.on-delete-order');
const btnConfirm = document.querySelector('.btn-order');
const inputMoney = document.querySelector('.input-money');
const countTotalOrder = document.querySelector('.count-total-order');
const pAlert = document.querySelector('.modal-body p');
let countTotal = 0;
let coverGetIdOrder = [];
let convertJsonIdOrder = '';

btnSee.forEach((btn) => {
   btn.addEventListener('click', () => {
       btn.parentElement.children[2].classList.toggle('d-none');

       if (!btn.parentElement.children[2].classList.contains('d-none')) {
            btn.parentElement.children[1].textContent = 'Tutup';
       } else {
           btn.parentElement.children[1].textContent = 'Lihat';
       }
   })
});

inputMoney.addEventListener('keyup',(e) => {
    const patternNumber = /^[0-9]+$/gmi;
    const regex = new RegExp(patternNumber);
    const amount = countTotalOrder.textContent.replace('Rp.', '')
        .replace('.','')
        .replace('.','');

    if (!regex.test(e.target.value)) {
        e.target.value = '';
        return false;
    } else {
        if (parseInt(e.target.value) > parseInt(amount)) {
            pAlert.textContent = 'Jumlah Uang Yang Dimasukkan Terlalu Besar'
        } else if (parseInt(e.target.value) === parseInt(amount)) {
            pAlert.textContent = 'Jumlah Uang Yang Dimasukkan Sudah Pas'
        } else if (parseInt(e.target.value) < parseInt(amount)) {
            pAlert.textContent = 'Jumlah Uang Yang Dimasukkan Terlalu Sedikit'
        }
    }
});

btnChecklistOrder.forEach((btn) => {
    btn.addEventListener('click', () => {
        let getValueIdOrder = btn.parentElement.children[0].value;
        let getPriceOrder = btn.parentElement.parentElement.children[6].textContent.
        replace('Rp. ', '')
            .replace('.','')
            .replace('.','');

        if (btn.checked) {
            countTotal += parseInt(getPriceOrder);
            coverGetIdOrder.push(getValueIdOrder);

            console.log(coverGetIdOrder);
        } else {
            countTotal -= parseInt(getPriceOrder);
            coverGetIdOrder = coverGetIdOrder.filter((e, index) => {
                return coverGetIdOrder.indexOf(getValueIdOrder) !== index;
            });

            console.log(coverGetIdOrder);
        }
        convertJsonIdOrder = JSON.stringify(coverGetIdOrder);
        countTotalOrder.textContent = "Rp. " + countTotal.toLocaleString('en-US')
            .replace(',','.')
            .replace(',','.');
    });
});

btnConfirm.addEventListener('click', ()=> {
    if (coverGetIdOrder.length <= 0) {
        swal({
            text: "Silahkan Pilih Tiket Yang Mau Diorder",
            buttons: {
                confirm : {text:'Ok',className:'sweet-warning'},
            },
        });
        return false;
    }
});

btnOrder.addEventListener('click', () => {
   if (coverGetIdOrder.length <= 0) {
       swal({
           text: "Silahkan Pilih Tiket Yang Mau Diorder",
           buttons: {
               confirm : {text:'Ok',className:'sweet-warning'},
           },
       });
       return false;
   } else {
       const amount = countTotalOrder.textContent.replace('Rp.', '')
           .replace('.','')
           .replace('.','');

       if (parseInt(inputMoney.value) !== parseInt(amount)) {
           swal({
               text: "Jumlah Uang Yang Anda Masukkan Masih Salah",
               buttons: {
                   confirm : {text:'Ok',className:'sweet-warning'},
               },
           });
           return false;
       }
       $.ajax({
           url: "/tiket/payment",
           type: "post",
           data: {
                idOrder : coverGetIdOrder
           },
           success: function (response) {
               swal({
                   text : "Pembayaran Berhasil",
                   buttons: {
                       confirm : {text:'Ok',className:'sweet-warning'},
                   },
               })
                   .then((value) => {
                       location.reload();
                   });
           },
           error: function(jqXHR, textStatus, errorThrown, error) {
               console.log(textStatus);
           }
       });
   }
});

btnDeleteOrder.forEach((button) => {
   button.addEventListener('click', () => {
       const valueIDOrder = button.previousElementSibling.value;
       swal({
           title: "Apakah Kamu Ingin Menghapus Data Orderan Ini",
           icon: "warning",
           buttons: true,
           dangerMode: true,
       })
           .then((willDelete) => {
               if (willDelete) {
                   $.ajax({
                       url: "/tiket/deleteOrder",
                       type: "post",
                       data: {
                           idOrder : valueIDOrder
                       },
                       success: function (response) {
                           swal({
                               text : "Berhasil Dihapus Data Orderan",
                               buttons: {
                                   confirm : {text:'Ok',className:'sweet-warning'},
                               },
                           })
                               .then((value) => {
                                   location.reload();
                               });
                       },
                       error: function(jqXHR, textStatus, errorThrown, error) {
                           console.log(textStatus);
                       }
                   });
               } else {
                   swal({
                       text : "Data Orderan Batal Dihapus",
                       buttons: {
                           confirm : {text:'Ok',className:'sweet-warning'},
                       },
                   })
               }
           });
   })
});

btnPayment.forEach((btn) => {
   btn.addEventListener('click', () => {
       if (btn.textContent === 'Belum Dibayar') {
            completePaymentComponent.classList.toggle('d-none');

            if (incompletePaymentComponent.classList.contains('d-none')) {
                incompletePaymentComponent.classList.toggle('d-none');
            } else if (!completePaymentComponent.classList.contains('d-none')) {
                completePaymentComponent.classList.toggle('d-none');
            }

       } else if (btn.textContent === 'Sudah Dibayar') {

           if (completePaymentComponent.classList.contains('d-none')) {
               completePaymentComponent.classList.toggle('d-none');
           }
           if (!incompletePaymentComponent.classList.contains('d-none')) {
               incompletePaymentComponent.classList.toggle('d-none');
           }
       }
   });
});

setInterval(() => {
    let d = new Date();
    let date = d.getDate();
    let month = d.getMonth() + 1;
    let year = d.getFullYear();

    let hours = d.getHours();
    let mins = d.getMinutes();
    let seconds = d.getSeconds();

    dateTime.textContent = year + "-" + month + "-" + date + " " + hours + ":" + mins + ":" + seconds;
},1000);
