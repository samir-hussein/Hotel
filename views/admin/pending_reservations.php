<section>
    <div class="content mt-3">
        <?php if (isset($this->loadData['success'])) : ?>
            <div class="alert alert-success msg"><?= $this->loadData['success'] ?></div>
        <?php endif; ?>
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">pending reservations</strong>
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
                                        <th>cost</th>
                                        <th>confirm reservation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($this->loadData['clients'])) {
                                        foreach ($this->loadData['clients'] as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['national_id'] ?></td>
                                                <td><?= $row['rooms_names'] ?></td>
                                                <td><?= $row['room_type'] ?></td>
                                                <td><?= $row['total_cost'] ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="text" name="id" value="<?= $row['id'] ?>" hidden>
                                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>&nbsp; confirm</button>
                                                    </form>
                                                </td>
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
    });
</script>