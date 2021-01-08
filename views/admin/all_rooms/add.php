<div class="card">
    <div class="card-header">
    <strong>add</strong> room
    </div>
    <?php if (isset($this->loadData['allInputs']['error'])): ?>
        <div class="alert alert-danger msg"><?=$this->loadData['allInputs']['error']?></div>
        <?php endif;?>
        <?php if (isset($this->loadData['allInputs']['success'])): ?>
        <div class="alert alert-success msg"><?=$this->loadData['allInputs']['success']?></div>
        <?php endif;?>
    <div class="card-body card-block">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group"><label class=" form-control-label">name</label><input name="name" value="<?=(isset($this->loadData['allInputs']['name'])) ? $this->loadData['allInputs']['name'] : ''?>" type="text" class="form-control"></div>
            <input type="text" name="id" value="<?=$_GET['edit']?>" hidden>
            <div class="form-group">
                <label class=" form-control-label">room type</label>
                <select name="type" class="form-control">
                    <?php
if (isset($this->loadData['types'])) {
    foreach ($this->loadData['types'] as $row) {
        ?>
        <option value="<?=$row['name']?>" <?=(isset($this->loadData['allInputs']['type']) && $this->loadData['allInputs']['type'] == $row['name']) ? 'selected' : ''?>><?=$row['name']?></option>
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
