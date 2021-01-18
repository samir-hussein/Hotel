<div class="card">
    <div class="card-header">
        <strong>add</strong> food departments
    </div>
    <?php if (isset($this->loadData['error'])) : ?>
        <div class="alert alert-danger msg"><?= $this->loadData['error'] ?></div>
    <?php endif; ?>
    <?php if (isset($this->loadData['success'])) : ?>
        <div class="alert alert-success msg"><?= $this->loadData['success'] ?></div>
    <?php endif; ?>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group"><label class=" form-control-label">food type</label><input name="type" value="<?= (isset($this->loadData['type'])) ? $this->loadData['type'] : '' ?>" type="text" class="form-control"></div>
            <div>
                <button type="submit" name="add" class="btn btn-primary btn-md">Add</button>
            </div>
        </form>
    </div>
</div>