<div class="card">
    <div class="card-header">
    <strong>add</strong> room type
    </div>
    <?php if (isset($this->loadData['error'])): ?>
        <div class="alert alert-danger msg"><?=$this->loadData['error']?></div>
        <?php endif;?>
        <?php if (isset($this->loadData['success'])): ?>
        <div class="alert alert-success msg"><?=$this->loadData['success']?></div>
        <?php endif;?>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group"><label class=" form-control-label">name</label><input name="name" value="<?=(isset($this->loadData['name'])) ? $this->loadData['name'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">adults</label><input name="adults" value="<?=(isset($this->loadData['adults'])) ? $this->loadData['adults'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">children</label><input name="children" value="<?=(isset($this->loadData['children'])) ? $this->loadData['children'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">Categories</label><input name="Categories" value="<?=(isset($this->loadData['Categories'])) ? $this->loadData['Categories'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">bed_type</label><input name="bed_type" value="<?=(isset($this->loadData['bed_type'])) ? $this->loadData['bed_type'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">cost</label><input name="cost" value="<?=(isset($this->loadData['cost'])) ? $this->loadData['cost'] : ''?>" type="text" class="form-control"></div>
            <div class="form-group"><label class=" form-control-label">facilities</label><textarea name="facilities" class="form-control" rows="5"><?=(isset($this->loadData['facilities'])) ? $this->loadData['facilities'] : ''?></textarea></div>
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
