<div class="card">
    <div class="card-header">
        <strong class="card-title">all room types data</strong>
    </div>
    <?php if (isset($this->loadData['error'])) : ?>
        <div class="alert alert-danger msg"><?= $this->loadData['error'] ?></div>
    <?php endif; ?>
    <?php if (isset($this->loadData['success'])) : ?>
        <div class="alert alert-success msg"><?= $this->loadData['success'] ?></div>
    <?php endif; ?>
    <?php if (isset($_GET['success'])) : ?>
        <div class="alert alert-success msg">modified successfully</div>
    <?php endif; ?>
    <div class="card-body">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">image</th>
                    <th scope="col">name</th>
                    <th scope="col">adults</th>
                    <th scope="col">children</th>
                    <th scope="col">Categories</th>
                    <th scope="col">bed_type</th>
                    <th scope="col">facilities</th>
                    <th scope="col">cost</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($this->loadData['allData'])) {
                    foreach ($this->loadData['allData'] as $row) {
                ?>
                        <tr>
                            <td><img src="/assets/images/<?= $row['image'] ?>" alt="" width="200" height="100"></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['adults'] ?></td>
                            <td><?= $row['children'] ?></td>
                            <td><?= $row['Categories'] ?></td>
                            <td><?= $row['bed_type'] ?></td>
                            <td><?= $row['facilities'] ?></td>
                            <td><?= $row['cost'] ?>$ / per night</td>
                            <td>
                                <form action="" method="post" class="d-inline">
                                    <input type="text" name="id" value="<?= $row['id'] ?>" hidden>
                                    <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Do you want to delete this?')">Delete</button>
                                </form>
                                <a href="/admin/add_room_type?edit=<?= $row['id'] ?>"><button class="btn btn-success">Edit</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9" class="text-center">there is no data to show</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>