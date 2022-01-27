console.log("WORK");
const buttonClose = document.querySelectorAll(".btn-close");
const buttonDelete = document.querySelectorAll(".on-delete");
const buttonDeleteTempat = document.querySelectorAll(".on-delete-place");
const buttonDeleteHarga = document.querySelectorAll(".on-delete-harga");
const buttonDeleteTicket = document.querySelectorAll(".on-delete-ticket");
const buttonDeleteOrder = document.querySelectorAll(".on-delete-order");
const buttonDeleteUser = document.querySelectorAll(".on-delete-user");
const inputHarga = document.querySelectorAll(".input-harga");
const detailSupir =  document.querySelectorAll(".detail-id-supir");
const detailPlace = document.querySelectorAll(".detail-id-place");
const detailHarga = document.querySelectorAll(".detail-id-harga");
const detailUser = document.querySelectorAll(".detail-id-user");
const detailTicket = document.querySelectorAll(".detail-id-ticket");
const closeButton = document.querySelector('.close');
const detailInfo = document.querySelector('.modal-body');

// Function Hapus Data
const hapusData = (message, url, valueJSON) => {
    return swal({
        title: message,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({

                    url : url,
                    type : 'POST',
                    data : valueJSON,
                    dataType:'json',
                    success : function(data) {
                        console.log(data);
                        swal("Good job!", data, "success").then(function(){
                            location.reload();
                        });
                    },
                    error : function(request,error) {
                        swal("Pesan", `Request: Tidak Dapat Menghapus Karena Data Ini Sedang Digunakan`);
                    }
                });
            } else {
                swal("Data Batal Dihapus");
            }
        });
};

// Function Detail Info
const detailDataInfo = (url, valueJSON) => {
    return $.ajax({
        url : url,
        type: "POST",
        data: valueJSON,
        dataType: 'json',
        success: function(data) {
            return data
        },
        error: function(xhr, status, error) {
            return status
        }
    })
};

inputHarga.forEach((harga) => {
   harga.addEventListener("keyup", () => {
       if (isNaN(parseInt(harga.value))) {
           harga.value = "";
       } else {
           let value = harga.value.replace(/[\D\s\._\-]+/g, "");
           harga.value = parseInt(value).toLocaleString("en-US");
           console.log(harga.value);
       }

   })
});

buttonClose.forEach((button) => {
   button.addEventListener("click", () => {
      button.parentElement.style.display = "none";
   });
});

buttonDelete.forEach((button) => {
   button.addEventListener("click", () => {
       let url = '/DashboardSupir/deleteSupir';
       let valueIdSupir = {
           'idSupir' : button.previousElementSibling.value
       };
      return hapusData("Apakah Kamu Yakin Ingin Menghapus Data Supir ? ",url, valueIdSupir);
   });
});

buttonDeleteHarga.forEach((button) => {
    button.addEventListener("click", () => {
        let url = '/DashboardHarga/deleteHarga';
        let valueIdHarga = {
            'idHarga' : button.previousElementSibling.value
        };
        return hapusData("Apakah Kamu Yakin Ingin Menghapus Data Harga ? ",url, valueIdHarga);
    });
});

buttonDeleteTempat.forEach((button) => {
    button.addEventListener("click", () => {
        let url = '/DashboardTempat/deleteTempat';
        let valueIdTempat = {
            'idPlace' : button.previousElementSibling.value
        };
        return hapusData("Apakah Kamu Yakin Ingin Menghapus Data Tempat ? ",url, valueIdTempat);
    });
});

buttonDeleteTicket.forEach((button) => {
   button.addEventListener("click", () => {
       let url = '/DashboardAdmin/deleteTicket';
        let valueIDTicket = {
            'idTicket' : button.previousElementSibling.value
        };

        return hapusData('Apakah Kamu Yakin Ingin Menghapus Data Ticket ? ', url, valueIDTicket)
   })
});

buttonDeleteOrder.forEach((button) => {
   button.addEventListener('click', async () => {
       let url = '/DashboardOrder/deleteOrder';
       let valueIDOrder = {
           'idOrder' : button.previousElementSibling.value
       };

       return hapusData('Apakah Kamu Yakin Ingin Menghapus Data Order User ? ', url, valueIDOrder)
   });
});

buttonDeleteUser.forEach((button) => {
   button.addEventListener('click', () => {
       let url = '/DashboardUser/deleteUser';
       let valueIDUser = {
           'idUser' : button.previousElementSibling.value
       };

       return hapusData('Apakah Kamu Yakin Ingin Menghapus User ? ', url, valueIDUser);

   })
});

detailSupir.forEach((button) => {
   button.addEventListener("click", async () => {
       let url = '/DashboardAdmin/getDetailInfo';
       let valueIDSupir = {
           'idSupir' : button.previousElementSibling.value
       };
       const result = await detailDataInfo(url, valueIDSupir);
       detailInfo.innerHTML = `
              <div class="detail fw-normal">
                <img class="img-fluid rounded" src="https://images.unsplash.com/photo-1558494390-6178bc5799e6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=327&q=80" alt="">
                <p class="mt-3">ID - Supir : ${result.idSupir}</p>
                <p>Nama : ${result.nama}</p>
                <p>Handphone : ${result.handphone}</p>
                <p>Alamat : ${result.alamat}</p>
              </div>
       `;
   });
});

detailPlace.forEach((button) => {
   button.addEventListener("click", async () => {
       let url = '/DashboardAdmin/getDetailInfo';
       let valueIDPlace = {
         'idPlace' : button.previousElementSibling.value
       };
       const result = await detailDataInfo(url, valueIDPlace);
       detailInfo.innerHTML = `
              <div class="detail fw-normal">
                <img class="rounded img-fluid" src="https://images.unsplash.com/photo-1554043536-3a191e765888?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80" alt="">
                <p class="mt-3">ID - Place : ${result.idPlace}</p>
                <p>Nama : ${result.asal}</p>
                <p>Handphone : ${result.tujuan}</p>
              </div>
       `;
   });
});

detailHarga.forEach((button) => {
   button.addEventListener("click", async () => {
       let url = '/DashboardAdmin/getDetailInfo';
       let valueIDHarga = {
           'idHarga' : button.previousElementSibling.value
       };
       const result = await detailDataInfo(url, valueIDHarga);
       detailInfo.innerHTML = `
              <div class="detail fw-normal">
                <img class="rounded img-fluid" src="https://images.unsplash.com/photo-1603777953662-5310c93eeb1c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="">
                <p class="mt-3">ID - Harga : ${result.idHarga}</p>
                <p>Harga : ${result.harga}</p>
                <p>Category : ${result.fasilitas}</p>
                <p>Keterangan : ${result.keterangan}</p>
              </div>
       `;
   })
});

detailUser.forEach((button) => {
   button.addEventListener('click', async () => {
       let url = '/DashboardAdmin/getDetailInfo';
       let valueIDUser = {
           idUser : button.previousElementSibling.value
       };

       const getDetailUser  = await detailDataInfo(url, valueIDUser);
       detailInfo.innerHTML = `
              <div class="detail fw-normal">
                    <img class="rounded img-fluid" src="https://images.unsplash.com/photo-1603777953662-5310c93eeb1c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="">
                    <p class="mt-3">ID - User : ${getDetailUser.idUser}</p>
                    <p>Nama : ${getDetailUser.nama}</p>
                    <p>Username : ${getDetailUser.username}</p>
                    <p>Email : ${getDetailUser.email}</p>
                    <p>Handphone : ${getDetailUser.handphone}</p>
                    <p>Alamat : ${getDetailUser.alamat}</p>
              </div>
       `
   });
});

detailTicket.forEach((button) => {
   button.addEventListener('click', async () => {
       let url = '/DashboardAdmin/getDetailInfo';
       let valueIDTicket = {
           idTicket : button.previousElementSibling.value
       };

       const getDetailTicket = await detailDataInfo(url, valueIDTicket);
       detailInfo.innerHTML = `
              <div class="detail fw-normal">
                    <img class="rounded img-fluid" src="https://images.unsplash.com/photo-1603777953662-5310c93eeb1c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="">
                    <p class="mt-3">ID - Ticket : ${getDetailTicket.idTicket}</p>
                    <p>Nama Bus : ${getDetailTicket.namaBus}</p>
                    <p>Nama Supir : ${getDetailTicket.nama}</p>
                    <p>Handphone Supir : ${getDetailTicket.handphone}</p>
                    <p>Asal Keberangkatan: ${getDetailTicket.asal}</p>
                    <p>Tujuan Keberangkatan: ${getDetailTicket.tujuan}</p>
                    <p>Fasilitas: ${getDetailTicket.fasilitas}</p>
                    <p>Jumlah Penumpang : ${getDetailTicket.jumlahPenumpang} Orang</p>
                    <p>Tanggal Berangkat : ${new Date(getDetailTicket.tanggalBerangkat).toLocaleDateString('id',{year: 'numeric', month: 'long', day: 'numeric'})}</p>
              </div>
            `
   })
});

closeButton.addEventListener('click', (e) => {
    const removeElement = closeButton.parentNode.previousElementSibling.childNodes[1];

    if (removeElement !== undefined) {
        closeButton.parentNode.previousElementSibling.removeChild(removeElement);
        console.log("Element Dihapus")
    }
});

