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
                $limit = 3;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                try {
                    $sql = "SELECT * FROM user order by user_id desc limit {$offset},{$limit}";
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

                try {
                    $sql1 = "SELECT * FROM user";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_all(MYSQLI_ASSOC);

                    if (count($row1) > 0) {
                        $total_record = count($row1);

                        $total_page = ceil($total_record / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo "<li class='active' ><a href='users.php?page=" . ($page - 1) . "' >prev</a></li>";
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo "<li class='{$active}'><a href='users.php?page=" . $i . "'>" . $i . "</a></li>";
                        }
                        if ($page < $total_page) {
                            echo "<li class='active'><a href='users.php?page=" . ($page + 1) . "'>next</a></li>";
                        }
                        echo "</ul>";
                    }
                } catch (Exception $e) {
                    echo $e->getMessage();
                    die();
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "header.php"; ?>