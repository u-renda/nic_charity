<div class="row">
    <div class="col-md-4">
        <select class="form-control">
            <option value="">-- Dilihat Dulu --</option>
            <?php
            foreach ($user_lists as $key => $val)
            { ?>
                <option value="<?php echo $val->user_id; ?>"><?php echo ucwords($val->username); ?></option>
            <?php
            }
            ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="padding-top10 padding-left15">
        <a class="btn btn-lg btn-primary" href="user_create" role="button">Tambah Penyumbang</a>
        <a class="btn btn-lg btn-success" href="barang_create" role="button">Tambah Barang</a>
    </div>
</div>
