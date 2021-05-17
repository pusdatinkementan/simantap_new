// Cari PNBP
$('#btnCariPNBP').on('click', function(e){
  
    $.ajax({
        url:'https://karantina.pertanian.go.id/api/publik/index.php/pnbpbarantan',
        type: 'GET',
        dataType: 'JSON',
        data: {           
            'karantina' : $('#InputKarantina').val(),
            'd1' : $('#dateFrom').val(),
            'd2' : $('#dateTo').val(),
            'key' : '3ac753bedb31742'
        }, 
        success: function(result){
            console.log(result.data);
        },
        error: function (result,error) {
            Swal.fire({
                title: 'Gagal',
                text: 'Data tidak ditemukan',
                type: 'error'
              })
        }
    })

});








