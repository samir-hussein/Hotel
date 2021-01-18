<?php
session_start();
if ($_SESSION['type'] == "admin") {
    $this->response->redirect("/admin");
    exit;
}
?>

<div class="card">
    <div class="card-header">
        <strong>Add User</strong>
    </div>
    <?php if (isset($this->loadData['error'])) : ?>
        <div class="alert alert-danger msg"><?= $this->loadData['error'] ?></div>
    <?php endif; ?>
    <?php if (isset($this->loadData['success'])) : ?>
        <div class="alert alert-success msg"><?= $this->loadData['success'] ?></div>
    <?php endif; ?>
    <div class="card-body card-block">
        <form action="" method="post">
            <div class="form-group"><label for="nf-email" class=" form-control-label">Name</label><input type="text" name="name" placeholder="Enter Name.." class="form-control" value="<?= (isset($this->loadData['name'])) ? $this->loadData['name'] : '' ?>"></div>
            <div class="form-group"><label for="nf-email" class=" form-control-label">Email</label><input type="email" name="email" placeholder="Enter Email.." class="form-control" value="<?= (isset($this->loadData['email'])) ? $this->loadData['email'] : '' ?>"></div>
            <div class="form-group"><label for="nf-password" class=" form-control-label">Password</label><input type="password" name="pass" placeholder="Enter Password.." class="form-control" value="<?= (isset($this->loadData['pass'])) ? $this->loadData['pass'] : '' ?>"></div>
            <div class="mb-5">
                <div class="form-check">
                    <div class="checkbox">
                        <label for="checkbox1" class="form-check-label ">
                            <input type="radio" name="checkbox" value="owner" class="form-check-input" <?= (isset($this->loadData['checkbox']) && $this->loadData['checkbox'] == "owner") ? 'checked' : '' ?>>Owner
                        </label>
                    </div>
                    <div class="checkbox">
                        <label for="checkbox2" class="form-check-label ">
                            <input type="radio" name="checkbox" value="admin" class="form-check-input" <?= (isset($this->loadData['checkbox']) && $this->loadData['checkbox'] == "admin") ? 'checked' : '' ?>>Admin
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <button type="submit" name="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Add
                </button>
            </div>
        </form>
    </div>
</div>