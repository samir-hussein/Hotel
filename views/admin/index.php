<section class="p-5">
    <?php
    ?>
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card no-padding">
                <div class="card-body">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="h4 mb-0">
                        <span class="count"><?= $this->loadData['total_visits'] ?></span>
                    </div>
                    <small class="text-muted text-uppercase font-weight-bold">Total Visits</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card no-padding">
                <div class="card-body">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="h4 mb-0">
                        <span class="count"><?= $this->loadData['visitors'] ?></span>
                    </div>
                    <small class="text-muted text-uppercase font-weight-bold">Visitors</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card no-padding">
                <div class="card-body">
                    <div class="h1 text-muted text-right mb-4">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="h4 mb-0">
                        <span class="count"><?= $this->loadData['daily_visits'] ?></span>
                    </div>
                    <small class="text-muted text-uppercase font-weight-bold">Daily Visits</small>
                    <div class="progress progress-xs mt-3 mb-0 bg-flat-color-1" style="width: 40%; height: 5px;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title text-center">check in today</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>national id</th>
                                        <th>rooms</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($this->loadData['check_in'])) {
                                        foreach ($this->loadData['check_in'] as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['national_id'] ?></td>
                                                <td><?= $row['rooms_names'] ?></td>
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

<section>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">check out today</strong>
                        </div>
                        <div class="card-body">
                            <table id="check_out_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>phone</th>
                                        <th>national id</th>
                                        <th>rooms</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($this->loadData['check_out'])) {
                                        foreach ($this->loadData['check_out'] as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['phone'] ?></td>
                                                <td><?= $row['national_id'] ?></td>
                                                <td><?= $row['rooms_names'] ?></td>
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

<section>
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">empty rooms</strong>
                        </div>
                        <div class="card-body">
                            <table id="empty_rooms_table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>room Name</th>
                                        <th>room type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($this->loadData['empty_rooms'])) {
                                        foreach ($this->loadData['empty_rooms'] as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $row['name'] ?></td>
                                                <td><?= $row['type'] ?></td>
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
        $('#bootstrap-data-table-export').DataTable();
        $('#check_out_table').DataTable();
        $('#empty_rooms_table').DataTable();
    });
</script>