<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">Order Create</div>
            </div>
            <div class="portlet-body form">
                <form role="form" method="post" action="order_create" class="form-horizontal form-bordered form-row-stripped" id="form-create">
					<input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/>
					<div class="form-body">
					  <?php for ($i=1;$i<=10;$i++): ?>
					  <div class="form-group">
						  <label class="control-label col-md-3">Kode Barang </label>
						  <div class="col-md-9">
							  <input type="text" id="<?php echo 'barang_id_'.$i; ?>" name="<?php echo 'barang_id_'.$i; ?>" placeholder="01100001" class="form-control" value="<?php echo set_value('barang_id_'.$i); ?>">
						  </div>
					  </div>
					  <?php endfor; ?>
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" id="submit" name="submit" class="btn btn-primary" value="Create New">
                                <i class="fa fa-check"></i> Order
                            </button>
                            <button type="reset" class="btn btn-default" value="Clear Data"> Clear </button>
                            <button type="button" class="btn bg-color-grey" onclick="goBack()"> Cancel </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function ()
{
	$("#form-create").validate({
		submitHandler: function(form) {
		  $('.modal-title').text('Please wait...');
		  $('.modal-body').html('<i class="fa fa-spinner fa-spin" style="font-size: 34px;"></i>');
		  $('.modal-dialog').addClass('modal-sm');
		  $('#myModal').modal('show');
		  $.ajax(
		  {
			  type: "POST",
			  url: form.action,
			  data: $(form).serialize(), 
			  cache: false,
			  success: function(data)
			  {
				  $('#myModal').modal('hide');
				  var response = $.parseJSON(data);
				  noty({dismissQueue: true, force: true, layout: 'top', theme: 'defaultTheme', text: response.msg, type: response.type, timeout: 2000});
				  if (response.type == 'success')
				  {
					  setTimeout("location.href = '"+response.location+"'",2000);
				  }
			  }
		  });
		  return false;
	  }
  });
});

function goBack() {
    window.history.back()
}
</script>