<div class="card">
    <div class="card-header">
        <strong>add</strong> food
    </div>
    <?php if (isset($this->loadData['allInputs']['error'])) : ?>
        <div class="alert alert-danger msg"><?= $this->loadData['allInputs']['error'] ?></div>
    <?php endif; ?>
    <?php if (isset($this->loadData['allInputs']['success'])) : ?>
        <div class="alert alert-success msg"><?= $this->loadData['allInputs']['success'] ?></div>
    <?php endif; ?>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group"><label class=" form-control-label">name</label><input name="name" value="<?= (isset($this->loadData['allInputs']['name'])) ? $this->loadData['allInputs']['name'] : '' ?>" type="text" class="form-control"></div>
            <div class="form-group">
                <label class=" form-control-label">department</label>
                <select name="type" class="form-control">
                    <?php
                    if (isset($this->loadData['departments'])) {
                        foreach ($this->loadData['departments'] as $row) {
                    ?>
                            <option value="<?= $row['type'] ?>" <?= (isset($this->loadData['allInputs']['type']) && $this->loadData['allInputs']['type'] == $row['type']) ? 'selected' : '' ?>><?= $row['type'] ?></option>
                        <?php
                        }
                    } else {
                        ?>
                        <option value="">there is no departments</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group"><label class=" form-control-label">price</label><input name="price" value="<?= (isset($this->loadData['allInputs']['price'])) ? $this->loadData['allInputs']['price'] : '' ?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">details</label><input name="details" value="<?= (isset($this->loadData['allInputs']['details'])) ? $this->loadData['allInputs']['details'] : '' ?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">choose image</label><input type="file" name="image" class="form-control-file"></div>
            <?php
            if (isset($this->loadData['allInputs']['image'])) {
            ?>
                <img src="/assets/images/<?= $this->loadData['allInputs']['image'] ?>" width="200" height="100" alt="" class="mb-3">
                <input type="text" name="id" value="<?= $_GET['edit'] ?>" hidden>
                <input type="text" name="editImage" value="<?= $this->loadData['allInputs']['image'] ?>" hidden>
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