        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
                  <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body"></div>
              </div>
            </div>
        </div>
        
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url('assets/js'); ?>/bootstrap.min.js" type="text/javascript"></script>
        <!-- Header Dropdown -->
        <script src="<?php echo base_url('assets/js'); ?>/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <!-- Upload image -->
        <script src="<?php echo base_url('assets/js'); ?>/bootstrap-fileinput.js" type="text/javascript"></script>
        <!-- Datepicker -->
        <script src="<?php echo base_url('assets/js'); ?>/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Validate -->
        <script src="<?php echo base_url('assets/js'); ?>/jquery.validate.js" type="text/javascript"></script>
        <!-- Chart -->
        <script src="<?php echo base_url('assets/js/chart'); ?>/highcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/chart'); ?>/exporting.js" type="text/javascript"></script>
        <!-- Notification -->
        <script src="<?php echo base_url('assets/js/noty'); ?>/jquery.noty.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/noty'); ?>/notytop.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js/noty'); ?>/notydefault.js" type="text/javascript"></script>
        <!-- Disable/Enable checkbox -->
        <script src="<?php echo base_url('assets/js'); ?>/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <!-- Tampilan -->
        <script src="<?php echo base_url('assets/js'); ?>/jquery.uniform.min.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url('assets/js'); ?>/metronic.js" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/js'); ?>/layout.js" type="text/javascript"></script>
        <script>
        jQuery(document).ready(function() {    
           Metronic.init(); // init metronic core componets
           Layout.init(); // init layout
        });
        </script>
    </body>
</html>