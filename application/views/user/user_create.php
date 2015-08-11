<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">User Create</div>
            </div>
            <div class="portlet-body form">
                <form role="form" method="post" action="user_create" class="form-horizontal form-bordered form-row-stripped" id="form-create">
					<div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Penyumbang <span class="fg-color-red">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="username" name="username" placeholder="Agnez Mo" class="form-control" value="<?php echo set_value('username'); ?>">
                                <div class="fg-color-red" id="errorbox_username"></div>
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
			username: "required"
		},
		messages: {
			username: {
				required:"Please insert username."
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