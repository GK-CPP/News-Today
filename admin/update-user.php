<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                include "config.php";
                $id = $_GET['id'];

                try {
                    $sql = "SELECT * FROM user WHERE user_id = '{$id}'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                ?>

                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo $row['first_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo $row['last_name']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?php echo $row['role']; ?>">
                                    <?php if ($row['role'] == 1) {  ?>
                                        echo "<option value='0'>normal User</option>";
                                        echo "<option value='1' selected>Admin</option>";
                                    <?php } else { ?>
                                        echo "<option value='1'>Admin</option>";
                                        echo "<option value='0' selected>normal User</option>";

                                    <?php } ?>
                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php

                    } else {
                        echo "<div class='alert alert-danger'>User Not Found.</div>";
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    die();
                }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>