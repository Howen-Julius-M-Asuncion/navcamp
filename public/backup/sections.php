<?php
    session_start();
    include_once('../config/config.php');
    include_once('../config/dbcon.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Searching - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include_once('../components/user-sidebar.php');?>
            <div class="row controls mx-4 mt-4">
                <div class="col bg-light rounded-3 p-3 shadow-sm mb-5 me-2">
                    <div class="row d-flex justify-content-end">
                        <div class="col-8 filter-actions">
                            <label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Any floors</option>
                                    <option value="1">Floor one</option>
                                    <option value="2">Floor two</option>
                                    <option value="3">Floor three</option>
                                </select>
                            </label>
                            <label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Any buildings</option>
                                    <option value="1">Building one</option>
                                    <option value="2">Building two</option>
                                    <option value="3">Building three</option>
                                </select>
                            </label>
                            <label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Any categories</option>
                                        <?php
                                        $result2 = $conn->query("SELECT * FROM room_types");
                                            while($userList=$result2->fetch_assoc()){
                                        ?>
                                    <option value="<?= $userList['type_id'] ?>"><?= $userList['function'] ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                            </label>
                            <label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Any status</option>
                                        <?php
                                        $result2 = $conn->query("SELECT * FROM room_types");
                                            while($userList=$result2->fetch_assoc()){
                                        ?>
                                    <option value="<?= $userList['type_id'] ?>"><?= $userList['function'] ?></option>
                                        <?php
                                            }
                                        ?>
                                </select>
                            </label>
                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal"><i class="fa-solid fa-filter"></i>&nbsp;Filter</button>
                        </div>
                        <div class="col search">
                            <div class="table-search">
                                <label>
                                    <input id="searchInput" type="text" placeholder="Search for rooms...">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</body>
<script></script>
</html>
<?php
    session_destroy();
?>