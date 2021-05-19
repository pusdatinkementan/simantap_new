<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-12">
    <form action="<?= base_url('menu/editsubmenu/'.$subMenu['id']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" value="<?=$subMenu['title'];?>" placeholder="Submenu title">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>                         
                            <?php 
                            $submenu2 = $subMenu['id'];
                            foreach ($menu as $m){ 
                                $selected = "";
                                    if($m['id'] == $submenu2){

                                        $selected = 'selected = "selected"';
                                    }
                                   echo  '<option value="'.$m['id'].'" '.$selected.'>'.$m['menu'].'</option>';
                                }
                                ?>
                    
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" value="<?=$subMenu['url'];?>" placeholder="Submenu url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" value="<?=$subMenu['icon'];?>" placeholder="Submenu icon">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

            </div>

    </div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

