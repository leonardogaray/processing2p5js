<?php require '_header.php';?>
<?php require 'backend/tp1.php';?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">TP #1</h1>
    </div>

    <?php foreach($result as $row) { ?>
    <div class="row">
        <div class="col-lg-8">
            <!-- Default Card Example -->
            <div class="card">
                <div class="card-header">
                    <?php echo $row["firstname"] . ' ' . $row["lastname"]; ?>
                </div>
                <div class="card-body">
                  <pre class="form-control processing-codes" id="<?php echo 'p_' . $row["uid"]; ?>" name="" style="height:280px">
                    <?php echo $row["onlinetext"]; ?>
                  </pre>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Default Card Example -->
            <div class="card">
                <div class="card-header">
                    Work
                </div>
                <div class="card-body">
                    <div class="col-lg-12 d-flex justify-content-center align-self-center" id="<?php echo 'u_' . $row["uid"]; ?>">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    </div>
                </div>
            </div>
        </div>
        <div id="<?php echo 'p5jsu_' . $row["uid"]; ?>" class="d-none"></div>
    </div>
    <?php } ?>
</div>
<!-- /.container-fluid -->

<?php require '_footer.php';?>