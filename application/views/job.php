<?= $this->session->flashdata('alert') ?>
<div class="content-wrapper">
    
    <div class="content-header">
     	<div class="container-fluid">
        	<div class="row mb-2">
          		<div class="col-sm-6">
            		<h5 class="m-0"><?= $header ?></h5>
          		</div>
          		<div class="col-sm-6">
            		<ol class="breadcrumb float-sm-right">
                        <?php foreach($list as $list) { echo $list; } ?>
            		</ol>
          		</div>
        	</div>
      	</div>
    </div>

    <section class="content">
    	<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <?= $header ?>
                            <div class="card-tools">
                                <a href="<?= base_url('job/ApiData') ?>" class="btn btn-danger btn-sm"><?='Check '.$header?></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="<?= base_url('job/search') ?>" method="post">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="key" class="form-control" required>
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-primary btn-flat"><i class="fas fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                                <br>

                                <table class="table table-bordered" style="width: 100%;font-size: 14px;"> 
                                    <thead class="table table-warning" align="center">
                                        <tr>
                                            <th style="width: 5%">ID</th>
                                            <th style="width: 50%">Topic</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach ($model as $r) {
                                        ?>
                                        <tr>
                                            <td align="center"><?= $r->ID ?></td>
                                            <td><?= $r->Topic ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2 row">
                                <div class="col-md-6"> 
                                    All Data : <?= $total ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $links ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    	</div>
    </section>

</div>
