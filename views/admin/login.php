    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <h1 class="text-center fs-1">HOTEL</h1>
                </div>
                <div class="login-form">
                    <?php if (isset($this->loadData['error'])) : ?>
                        <div class="alert alert-danger"><?= $this->loadData['error'] ?></div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" value="<?= (isset($this->loadData['email'])) ? $this->loadData['email'] : '' ?>" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" value="<?= (isset($this->loadData['pass'])) ? $this->loadData['pass'] : '' ?>" class="form-control" placeholder="Password" name="pass">
                        </div>
                        <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>