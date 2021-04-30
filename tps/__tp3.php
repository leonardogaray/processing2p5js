<?php require '_header.php';?>
<?php require 'backend/tp3.php';?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">TP #3</h1>
    </div>

    <?php foreach($result as $row) { ?>
    <div class="row">
        <div class="col-lg-7">
            <!-- Default Card Example -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <?php echo $row["firstname"] . ' ' . $row["lastname"]; ?>
                    <a target="_blank" href="<?php echo $row["github"] ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i> 
                        Github
                    </a>
                    <a target="_blank" href="?userId=<?php echo $row["uid"]; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-user fa-sm text-white-50"></i> 
                        Single
                    </a>
                </div>
                <div class="card-body">
                  <iframe 
                    id="<?php echo 'pdf_' . $row["uid"]; ?>" 
                    src="../github_tp3/<?php echo $row["names"] . "_" . $row["project"];?>/tp3/tp3.pdf" 
                    style="width:100%;height:400px;"></iframe>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <!-- Default Card Example -->
            <div class="card">
                <div class="card-header">
                    Work
                </div>
                <div class="card-body">
                    <iframe 
                        id="<?php echo 'md_' . $row["uid"]; ?>" 
                        src="../github_tp3/<?php echo $row["names"] . "_" . $row["project"];?>/tp3/README.md" 
                        style="width:100%;height:400px;"></iframe>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<!-- /.container-fluid -->

<?php require '_footer.php';?>