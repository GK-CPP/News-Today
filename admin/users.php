<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">

                <?php
                include "config.php";

                try {
                    $sql = "SELECT * FROM user order by user_id desc";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                ?>
                        <table class="content-table">
                            <thead>
                                <th>S.No.</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($row as $key => $value) {
                                ?>
                                    <tr>
                                        <td class='id'><?php echo $key + 1; ?></td>
                                        <td><?php echo $value['first_name'] . " " . $value['last_name']; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value['role'] == 1 ? "Admin" : "Normal"; ?></td>
                                        <td class='edit'><a href="update-user.php ?id=<?php echo $value['user_id']; ?>"><i class='fa fa-edit'></i></a></td>
                                        <td class='delete'><a href="delete-user.php ?id=<?php echo $value['user_id']; ?>"><i class='fa fa-trash-o'></i></a></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                <?php
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    die();
                }

                ?>

                <ul class='pagination admin-pagination'>
                    <li class="active"><a>1</a></li>
                    <li><a>2</a></li>
                    <li><a>3</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>