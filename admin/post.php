<?php
include "config.php";
include "utilis.php";


?>


<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                $limit = 3;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                try {

                    if ($_SESSION["role"] == '1') {
                        $sql = "SELECT * FROM post 
                    left join category on post.category = category.category_id 
                    left join user on post.author = user.user_id 
                    order by post.post_id desc limit {$offset},{$limit}";
                    } elseif ($_SESSION["role"] == '0') {
                        $sql = "SELECT * FROM post 
                    left join category on post.category = category.category_id 
                    left join user on post.author = user.user_id
                    
                    where post.author = {$_SESSION['id']}
                    order by post.post_id desc limit {$offset},{$limit}";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_all(MYSQLI_ASSOC);
                ?>
                        <table class="content-table">
                            <thead>
                                <th>S.No.</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Author</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($row as $key => $value) {
                                ?>
                                    <tr>
                                        <td class='id'> <?php echo $key + 1; ?> </td>
                                        <td><?php echo $value['title']; ?></td>
                                        <td> <?php echo $value['category_name']; ?></td>
                                        <td><?php echo $value['post_date']; ?></td>
                                        <td><?php echo $value['first_name'] . '' . $value['last_name']; ?></td>
                                        <td class='edit'><a href='update-post.php ?id=<?php echo $value['post_id']; ?>'> <i class='fa fa-edit'></i></a></td>
                                        <td class='delete'><a href='delete-post.php?id=<?php echo $value['post_id']; ?>'> <i class='fa fa-trash-o'></i></a></td>
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
                    $sql1 = "SELECT * FROM post";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_all(MYSQLI_ASSOC);

                    if (count($row1) > 0) {
                        $total_record = count($row1);

                        $total_page = ceil($total_record / $limit);
                        echo "<ul class='pagination admin-pagination'>";
                        if ($page > 1) {
                            echo "<li class='active' ><a href='post.php?page=" . ($page - 1) . "' >prev</a></li>";
                        }
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                            echo "<li class='{$active}'><a href='post.php?page=" . $i . "'>" . $i . "</a></li>";
                        }
                        if ($page < $total_page) {
                            echo "<li class='active'><a href='post.php?page=" . ($page + 1) . "'>next</a></li>";
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
<?php include "footer.php"; ?>