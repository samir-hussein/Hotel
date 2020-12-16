<?php
    session_start();
    if($_SESSION['type'] == "admin"){
        $this->response->redirect("/admin");
        exit;
    }
?>
<div>
    <div class="card">
        <div class="card-header">
            <strong class="card-title">All Users</strong>
        </div>
        <?php if(isset($this->loadData['msg']['success'])):?>
        <div class="alert alert-success"><?=$this->loadData['msg']['success']?></div>
        <?php endif;?>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($this->loadData['table'] as $row)
                    {
                        ?>
                        <tr>
                            <td><?=$row['name']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['type']?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="text" name="delete" value="<?=$row['id']?>" hidden>
                                    <button class="btn btn-danger" type="submit" name="submit" onclick="return confirm('Do you want to delete this user?')"><i style="font-size: 20px;" class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>

        </div>
    </div>
</div>