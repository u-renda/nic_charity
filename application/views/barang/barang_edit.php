<h2>Barang Edit</h2>
<?php
echo form_open_multipart('barang_edit', 'id="form-create"');
?>
    <input type="hidden" id="id" name="id" value="<?php echo $barang->barang_id; ?>"/>
    <div class="form-group">
        <label>Status</label>
        <select class="form-control" name="status" id="status">
            <option value="">-- Select one --</option>
            <?php
            foreach ($code_barang_status as $key => $val)
            { ?>
                <option value="<?php echo $key; ?>" <?php if($barang->status == $key){ echo 'selected="selected"'; } ?>><?php echo $val; ?></option>
            <?php
            }
            ?>
        </select>
        <div class="fg-color-red" id="errorbox_status"></div>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" name="harga" id="harga" value="<?php echo $barang->harga; ?>">
        <div class="fg-color-red" id="errorbox_harga"></div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary" value="Create New">Update</button>
    <button type="button" class="btn bg-color-grey" onclick="goBack()"> Cancel </button>
<?php echo form_close(); ?>

<script type="text/javascript">
$(document).ready(function ()
{
	$("#form-create").validate({
        rules: {
			status: "required",
			harga: {
				required: true,
				digits: true
			}
		},
		messages: {
			status: {
				required:"Please insert username."
			},
			harga: {
				required:"Please insert harga."
			}
		},
        errorElement: "div",
        errorPlacement: function(error, element) {
            id = element.attr('id');
            error.appendTo($('#errorbox_'+id));
        }
    });
});

function goBack() {
    window.history.back()
}
</script>