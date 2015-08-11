<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">Barang - Lists</div>
            </div>
            <div class="form-header">
                <form role="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="user_create" role="button">Tambah Penyumbang</a>
								<a class="btn bg-red-google" href="barang_create_many" role="button">Tambah Barang</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
			<div class="form-header">
                <form role="form" class="form-horizontal" id="form-admin">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-sm-2">
                                <select class="form-control" id="user_id" name="user_id" >
                                <option value="">-- Penyumbang --</option>
                                <?php foreach ($user_lists as $row): ?>
                                    <option value="<?php echo $row->user_id; ?>" <?php echo set_select('user_id', $row->user_id); ?>><?php echo ucwords($row->username); ?></option>
                                <?php endforeach; ?>
								</select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control" id="status" name="status" >
                                <option value="">-- Status --</option>
                                <?php foreach ($code_barang_status as $key => $val): ?>
                                    <option value="<?php echo $key; ?>" <?php echo set_select('status', $key); ?>><?php echo $val; ?></option>
                                <?php endforeach; ?>
								</select>
                            </div>
                            <input type="submit" class="btn bg-red-google" value="Submit" />
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="portlet-body">
                <div id="multipleSort"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function ()
{
	resubmit();
	
    $('.delete').live("click",function() {
        var id = $(this).attr("id");
        var dataString = 'id='+ id +'&action=barang_delete'
        $.ajax(
        {
            type: "POST",
            url: 'barang_delete',
            data: dataString, 
            cache: false,
			beforeSend: function()
			{
				$('.'+id+'-delete').html('<i class="fa fa-spinner fa-spin"></i>');
			},
			success: function(data)
			{
				$('.'+id+'-delete').html('<i class="fa fa-times fg-color-red fg-font19"></i>');
				$('.modal-dialog').removeClass('modal-lg');
				$('.modal-dialog').addClass('modal-sm');
                $('.modal-title').text('Confirm Delete');
				$('.modal-body').html(data);
				$('#myModal').modal('show');
            }
        });
        return false;
    });
});

function resubmit() {
	$("#multipleSort").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    url: "barang_get",
                    dataType: "json",
                    type: "POST",
					data: {
                        user_id : $('#user_id').val(),
                        status : $('#status').val()
                    }
                }
            },
            schema: {
                data: "results",
                total: "total"
            },
            pageSize: 20,
            serverPaging: true,
            serverSorting: true,
			serverFiltering: true,
            cache: false
        },
        sortable: {
            mode: "single",
            allowUnsort: true
        },
        pageable: {
            buttonCount: 5,
            input: true,
            pageSizes: true,
            refresh: true
        },
        filterable: {
            extra: false,
            operators: {
                string: {
                    contains: "Mengandung kata"
                }
            }
        },
        selectable: "row",
		resizable: true,
        columns: [{
            field: "no",
            title: "No",
            sortable: false,
            filterable: false,
            width: 60
        },
        {
            field: "barang_id",
            title: "Kode Barang",
            width: 200
        },
        {
            field: "username",
            title: "Penyumbang",
            filterable: false,
            sortable: false
        },
        {
            field: "harga",
            title: "Harga",
            filterable: false,
            width: 200
        },
        {
            field: "status",
            title: "Status",
            sortable: false,
            filterable: false,
            width: 100,
            template: "#= data.status #"
        },
        {
            field: "action",
            title: "Action",
            sortable: false,
            filterable: false,
            width: 100,
            template: "#= data.action #"
        }]
    });
}

$('#form-admin').submit(function (){
    resubmit();
    $('#multipleSort').data('kendoGrid').refresh();
    return false;
});
</script>