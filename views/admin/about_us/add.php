<div class="card">
    <div class="card-header">
        <strong>add</strong> about us
    </div>
    <?php if (isset($this->loadData['error'])) : ?>
        <div class="alert alert-danger msg"><?= $this->loadData['error'] ?></div>
    <?php endif; ?>
    <?php if (isset($this->loadData['success'])) : ?>
        <div class="alert alert-success msg"><?= $this->loadData['success'] ?></div>
    <?php endif; ?>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group"><label class=" form-control-label">paragraph</label><textarea rows="5" name="p" class="form-control"><?= (isset($this->loadData['p'])) ? $this->loadData['p'] : '' ?></textarea></div>
            <div class="form-group"><label class=" form-control-label">choose video</label><input type="file" name="video" class="form-control-file"></div>
            <?php
            if (isset($this->loadData['video'])) {
            ?>
                <video src="/assets/videos/<?= $this->loadData['video'] ?>" width="400" height="200" alt="" class="mb-3" controls></video>
                <input type="text" name="id" value="<?= $_GET['edit'] ?>" hidden>
                <input type="text" name="editVideo" value="<?= $this->loadData['video'] ?>" hidden>
            <?php
            }
            ?>
            <div>
                <?php if (isset($_GET['edit'])) {
                ?>
                    <button type="submit" name="add" class="btn btn-primary btn-md" hidden>Add</button>
                    <button type="submit" name="edit" class="btn btn-primary btn-md">Edit</button>
                <?php
                } else {
                ?>
                    <button type="submit" name="add" class="btn btn-primary btn-md">Add</button>
                    <button type="submit" name="edit" class="btn btn-primary btn-md" hidden>Edit</button>
                <?php
                } ?>
            </div>
        </form>
    </div>
</div>