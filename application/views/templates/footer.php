            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Pusdatin Kementerian Pertanian <?= date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->

            <!-- <script src="<?= base_url('assets/'); ?>js/myscript.js"></script> -->

            <script>

                $('#tomboledit').on('click',function(){
                            Swal.fire({
                        title: 'Gagal',
                        text: 'Data tidak ditemukan',
                        type: 'error'
                    })
                });

                $('#btncaribpp').on('click',function(){
                    loadingproses();
                    var kab = $('#kab').val();
                    $('#showResult').html('');
                    
                    $.ajax({
                        url: "<?php echo base_url().'admin/caribpp/';?>"+ kab,
                        type: "GET",
                        dataType : "json",
                        success: function(result){
                            if(result){                       
                                $.each(result, function(i,data){
                                    var no = i+1;
                                     $("#showResult").append(`
                                     <tr>
                                        <th scope="row">`+ no +`</th>
                                        <td><a href="#" id="detailBpp" class="card-link" data-id=`+data.nama_bpp+`>`+data.nama_bpp+`</a></td>
                                        <td>`+data.alamat+`</td>
                                        <td>`+data.ketua+`</td>
                                        </tr>
                                        `);
                                    });  
                            }else{
                                    $('#showResult').html(`
                                        <div class="row">
                                        <h1 class="text-center">Error</h1>
                                        </div>
                                    `)
                                }
                                             
                        },
                        error: function (result,error) {
                            console.log('Error');
                        },
                        complete: function(response) {	
                            loadingproses_close();
                        }  	
                    });                    
                });

                $('#showResult').on('click','#detailBpp', function(){
                    alert($(this).data('id'));
                    $('#exampleModal').modal('show'); 
                    $('.modal-body').html(`
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?php echo base_url();?>assets/img/logo.png" class="img-fluid">
                                </div>
                                <div class="col-md-8">
                                    <ul class="list-group">
                                    <li class="list-group-item"><h3>Profil BPP `+$(this).data('id')+`</h3></li>
                                    <li class="list-group-item">Nama BPP: </li>
                                    <li class="list-group-item">Alamat: </li>
                                    <li class="list-group-item">Ketua: </li>
                                    <li class="list-group-item">Telp/Hp: </li>
                                    <li class="list-group-item">Email: </li>
                                    <li class="list-group-item">Status Gedung: </li>
                                    <li class="list-group-item">Luas Lahan: </li>
                                    </ul>
                                </div>
                            </div>
                        </div>`);
                });

                $('.custom-file-input').on('change', function() {
                    let fileName = $(this).val().split('\\').pop();
                    $(this).next('.custom-file-label').addClass("selected").html(fileName);
                });



                $('.form-check-input').on('click', function() {
                    const menuId = $(this).data('menu');
                    const roleId = $(this).data('role');

                    $.ajax({
                        url: "<?= base_url('admin/changeaccess'); ?>",
                        type: 'post',
                        data: {
                            menuId : menuId,
                            roleId : roleId
                        },
                        success: function() {
                            document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
                        }
                    });

                });
                </script>
           
     
            </body>

            </html> 