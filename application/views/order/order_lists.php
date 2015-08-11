<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
            <div class="portlet-title">
                <div class="caption">Order - Lists</div>
            </div>
            <div class="form-header">
                <form role="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="order_create?id=<?php echo $order_id; ?>" role="button">Tambah Order</a>
								<a class="btn bg-red-google" href="order_checkout?id=<?php echo $order_id; ?>" role="button">Selesai</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
            <div class="portlet-body">
                <div id="multipleSort"></div>
                <div class="clearfix"></div>
                <div class="margin-top10"><strong><h2>Total Pembelian = <?php echo $total; ?></h2></strong></div>
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
        var dataString = 'id='+ id +'&action=order_delete'
        $.ajax(
        {
            type: "POST",
            url: 'order_delete',
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
                    url: "order_get",
                    dataType: "json",
                    type: "POST",
                    data: {
						order_id : '<?php echo $order_id; ?>'
                    }
                }
            },
            schema: {
                data: "results",
                total: "total"
            },
            pageSize: 20,
            serverPaging: true,
            cache: false
        },
        pageable: {
            buttonCount: 5,
            input: true,
            pageSizes: true,
            refresh: true
        },
        selectable: "row",
		resizable: true,
        columns: [{
            field: "no",
            title: "No",
            width: 60
        },
        {
            field: "barang_id",
            title: "Kode Barang",
            width: 200
        },
        {
            field: "harga",
            title: "Harga",
            width: 200
        },
        {
            field: "action",
            title: "Action",
            width: 100,
            template: "#= data.action #"
        }]
    });
}
</script>