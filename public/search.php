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
    <title>Search result for <?php echo 'Lorem' ?> - <?php echo SITE_NAME?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo FAVICON;?>">
    <link href="./css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/71f85e3db5.js" crossorigin="anonymous"></script>
    <style>
        .card {
            height:100%;
        }
        .gradient-mask {
            position: relative;
            overflow: hidden;
            height: 70px;
        }
        .gradient-mask::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <?php include_once('../components/user-sidebar.php');?>
            <div class="row controls mx-4 mt-4">
                <div class="col bg-light rounded-3 p-3 shadow-sm mb-4">
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
                                    <?php
                                        $result1 = $conn->query("SELECT * FROM buildings");
                                            while($list=$result1->fetch_assoc()){
                                    ?>
                                    <option value="<?= $list['id'] ?>"><?= $list['building'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </label>
                            <label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Any categories</option>
                                    <?php
                                        $result2 = $conn->query("SELECT * FROM categories");
                                            while($list=$result2->fetch_assoc()){
                                    ?>
                                    <option value="<?= $list['id'] ?>"><?= $list['category'] ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </label>
                            <label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Any status</option>
                                    <option value="">Available</option>
                                    <option value="">Occupied</option>
                                    <option value="">Reserved</option>
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
            <div class="bg-light rounded p-3 shadow-sm mx-4">
                <div class="row px-3">
                    <div class="col d-flex justify-content-between my-2">

                    </div>
                </div>
                <div class="row row-cols-1 row-cols-md-4 g-4 px-3">
                    <?php 
                        $query = "SELECT * FROM rooms WHERE status='Available'";
                        $result = $conn->query($query);
                        
                        if ($result->num_rows < 0) {
                            echo "No Entries Found!";
                        }else{
                            while($list=$result->fetch_assoc()){
                    ?>
                    <div class="col-3">
                        <div class="card card-classroom">
                            <img src="<?php echo BASE_URL?>/public/images/building_default.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?=$list['code']?></h5>
                                <div class="gradient-mask">
                                    <p class="card-text"><?=$list['description']?></p>
                                </div>
                                <a href="#" class="btn btn-outline-dark">More Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
</script>
</html>
<?php
    session_destroy();
?>