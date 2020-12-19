<div class="card">
    <div class="card-header">
    <strong>add</strong> home slider
    </div>
    <?php if (isset($this->loadData['error'])): ?>
        <div class="alert alert-danger msg"><?=$this->loadData['error']?></div>
        <?php endif;?>
        <?php if (isset($this->loadData['success'])): ?>
        <div class="alert alert-success msg"><?=$this->loadData['success']?></div>
        <?php endif;?>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group"><label class=" form-control-label">bold head</label><input name="h" value="<?=(isset($this->loadData['h'])) ? $this->loadData['h'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">paragraph</label><input name="p" value="<?=(isset($this->loadData['p'])) ? $this->loadData['p'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">choose image</label><input type="file" name="image" class="form-control-file"></div>
            <?php
if (isset($this->loadData['image'])) {
    ?>
    <img src="/assets/images/<?=$this->loadData['image']?>" width="200" height="100" alt="" class="mb-3">
    <input type="text" name="id" value="<?=$_GET['edit']?>" hidden>
    <input type="text" name="editImage" value="<?=$this->loadData['image']?>" hidden>
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
}?>
            </div>
        </form>
    </div>
</div>
