<div class="card">
    <div class="card-header">
        <strong class="card-title">all about us data</strong>
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
                    <th scope="col">video</th>
                    <th scope="col">paragraph</th>
                    <th scope="col">actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($this->loadData['allData'])) {
                    foreach ($this->loadData['allData'] as $row) {
                ?>
                        <tr>
                            <td><video src="/assets/videos/<?= $row['vedio'] ?>" width="400" height="200" controls></video></td>
                            <td><?= $row['p'] ?></td>
                            <td>
                                <form action="" method="post" class="d-inline">
                                    <input type="text" name="id" value="<?= $row['id'] ?>" hidden>
                                    <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Do you want to delete this?')">Delete</button>
                                </form>
                                <a href="/admin/add_about_us?edit=<?= $row['id'] ?>"><button class="btn btn-success">Edit</button></a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3" class="text-center">there is no data to show</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>