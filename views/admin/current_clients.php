<section>
<div class="content mt-3">
<?php if (isset($this->loadData['success'])): ?>
        <div class="alert alert-success"><?=$this->loadData['success']?></div>
        <?php endif;?>
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">current clients</strong>
                        </div>
                        <div class="card-body">
    <table id="clients" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Name</th>
            <th>phone</th>
            <th>national id</th>
            <th>rooms</th>
            <th>rooms types</th>
            <th>check_in</th>
            <th>check_out</th>
            <th>actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
if (isset($this->loadData['clients'])) {
    foreach ($this->loadData['clients'] as $row) {
        ?>
                        <tr>
                            <td><?=$row['name']?></td>
                            <td><?=$row['phone']?></td>
                            <td><?=$row['national_id']?></td>
                            <td><?=$row['rooms_names']?></td>
                            <td><?=$row['room_type']?></td>
                            <td><?=$row['check_in']?></td>
                            <form action="" method="post">
                            <td><input type="date" name="out" value="<?=$row['check_out']?>"></td>
                            <td>
                            <input type="text" name="id" value="<?=$row['id']?>" hidden>
                            <input type="text" name="rooms" value="<?=$row['rooms_names']?>" hidden>
                            <input type="text" name="in" value="<?=$row['check_in']?>" hidden>
                            <button type="submit" name="renew" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; renew</button>
                            <button type="submit" name="check_out" class="btn btn-primary"><i class="fa fa-check"></i>&nbsp; check out</button>
                            <button type="submit" name="cancel_reservation" class="btn btn-danger"><i class="fa fa-check"></i>&nbsp; cancel reservation</button>
                            </td>
                            </form>
                        </tr>
                        <?php
}
}
?>
        </tbody>
        </table>
        </div>
                    </div>
                </div>


                </div>
            </div>
        </div>
</section>

<script type="text/javascript">
    $(document).ready(function() {
        $('#clients').DataTable();
    } );
</script>