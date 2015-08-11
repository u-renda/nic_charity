<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">Barang Create</div>
            </div>
            <div class="portlet-body form">
                <form role="form" method="post" action="barang_create_many" class="form-horizontal form-bordered form-row-stripped" id="form-create">
					<div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Penyumbang <span class="fg-color-red">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" name="username" id="username">
									<option value="">-- Select one --</option>
									<?php
									foreach ($user_lists as $key => $val)
									{ ?>
										<option value="<?php echo $val->user_id; ?>" <?php echo set_select('username', $val->user_id); ?>><?php echo ucwords($val->username); ?></option>
									<?php
									}
									?>
								</select>
                                <div class="fg-color-red" id="errorbox_username"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Harga <span class="fg-color-red">*</span></label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="200000" name="harga" id="harga" value="<?php echo set_value('harga'); ?>">
                                <div class="fg-color-red" id="errorbox_harga"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Quantity </label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" placeholder="100" name="qty" id="qty" value="<?php echo set_value('qty'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions fluid">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" id="submit" name="submit" class="btn btn-primary" value="Create New">
                                <i class="fa fa-check"></i> Create New
                            </button>
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
        rules: {
			username: "required",
			harga: "required"
		},
		messages: {
			username: {
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
        },
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
