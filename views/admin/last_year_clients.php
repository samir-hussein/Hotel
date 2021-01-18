<section>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">last year clients</strong>
                        </div>
                        <div class="card-body">
                            <table id="clients" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>national id</th>
                                        <th>rooms</th>
                                        <th>check in</th>
                                        <th>check out</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($this->loadData)) {
                                        foreach ($this->loadData as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['national_id'] ?></td>
                                                <td><?= $row['rooms_names'] ?></td>
                                                <td><?= $row['check_in'] ?></td>
                                                <td><?= $row['check_out'] ?></td>
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