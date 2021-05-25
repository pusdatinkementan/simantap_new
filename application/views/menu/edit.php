<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">

    <form action="<?= base_url('menu/editmenu/'.$menu['id']); ?>" method="post">
              
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="<?=$menu['menu'];?>">
                    </div>              
                    
                    <button type="submit" class="btn btn-primary">Edit</button>
        </form>


    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



