<?php
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/bootstrap/bootstrap3.min.css');
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/elusive-icons/css/elusive-icons.min.css');
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/common.css');
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/list.css');
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/general.css');
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/plugins/animate.min.css');
    $this->set_css($this->default_theme_path.'/bootstrap-v4/css/main.css');

    if ($this->config->environment == 'production') {
        $this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);
        $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/build/js/global-libs.min.js');
    } else {
        $this->set_js_lib($this->default_javascript_path.'/'.grocery_CRUD::JQUERY);
        $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/jquery-plugins/jquery.form.js');
        $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/common/cache-library.js');
        $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/common/common.js');
    }

    //section libs
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/jquery-plugins/gc-dropdown.min.js');
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/jquery-plugins/gc-modal.min.js');
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/jquery-plugins/bootstrap-growl.min.js');
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/jquery-plugins/jquery.print-this.js');


    //page js
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/datagrid/gcrud.datagrid.js');
    $this->set_js_lib($this->default_theme_path.'/bootstrap-v4/js/datagrid/list.js');


    $colspans = (count($columns) + 2);

    //Start counting the buttons that we have:
    $buttons_counter = 0;

    if (!$unset_edit) {
        $buttons_counter++;
    }

    if (!$unset_read) {
        $buttons_counter++;
    }

    if (!$unset_delete) {
        $buttons_counter++;
    }

    if (!empty($list[0]) && !empty($list[0]->action_urls)) {
        $buttons_counter = $buttons_counter +  count($list[0]->action_urls);
    }

    //The search column string exists only in version 1.5.6 or higher
    $search_column_string =
        preg_match('/1\.(5\.[6-9]|[6-9]\.[0-9])/', Grocery_CRUD::VERSION)
            ? $this->l('list_search_column') : 'Search {column_name}';

    $list_displaying = str_replace(
        array(
            '{start}',
            '{end}',
            '{results}'
        ),
        array(
            '<span class="paging-starts">1</span>',
            '<span class="paging-ends">10</span>',
            '<span class="current-total-results">'. $this->get_total_results() . '</span>'
        ),
        $this->l('list_displaying'));

    include(__DIR__ . '/common_javascript_vars.php');
?>
<script type='text/javascript'>
    var base_url = '<?php echo base_url();?>';

    var subject = '<?php echo $subject?>';
    var ajax_list_info_url = '<?php echo $ajax_list_info_url; ?>';
    var ajax_list_url = '<?php echo $ajax_list_url;?>';
    var unique_hash = '<?php echo $unique_hash; ?>';

    var message_alert_delete = "<?php echo $this->l('alert_delete'); ?>";
    var THEME_VERSION = '1.3.6';
</script>
<style>
    .gc-container{
        background: #fff;
        max-width: 100%;
        font-size: 14px;
        font-family: Verdana,Arial,sans-serif;
    }
    .gc-container .table-label{
        font-size: 14px;
        padding: 1px;
    }
    .gc-container .scroll-if-required {
        overflow: auto;
        padding-bottom: 0px;
    }
    .gc-container .footer-tools{
        background: #f9f9f9;
        margin: 0;
    }
    .table-section{
        width:100%;
    }
    .table td, .table th{
        padding: 8px;
    }
    .btn-group-xs>.btn, .btn-xs {
        padding: 1px 5px;
        font-size: 12px;
        line-height: 1.5;
        border-radius: 3px;
    }
    .gc-container .displaying-paging-items{
        margin:20px;
    }
    .page-number-input{
        margin: 0.2px;
    }
    .form-control{
        height: 34px;
        padding: 6px 12px;
    }
    td{
        white-space: nowrap;
    }
    .badge-pending{color: #000;background-color: #ffc107;}
    .badge-processing{color: #fff;background-color: #17a2b8;}
    .badge-processed{color: #fff;background-color: #28a745;}
    .badge-Rejected{color: #fff;;background-color: #dc3545;}    
    .badge-Queued{color: #fff;background-color: #6c757d;}
    .badge-Cancelled{color: #fff;background-color: #dc3545;}
    .badge-Reversed{color: #fff;background-color: #007bff;}

    .badge-failed{color: #fff;;background-color: #dc3545;}
    .badge-success{color: #fff;background-color: #28a745;}

    .bg-offwhite{background-color: #f9f9f9;}
    .text-cityg{color: #9ecf36;}
    .text-cityb{color: #36a7f8;}

</style>
    
    <div class="container gc-container mx-0 w-100">
        <div class="success-message hidden">
           <?php echo @$success_message.@$rfu_data['upload_msg']; ?>
        </div>

 		<div class="row">
        	<div class="table-section">
                <div class="table-label">




                </div>
                <div class="table-container">
        
        			<?php if(@$rfu_data['upload']) {?>
        			<div class="floatR t5 l5 r5">
            			<form action="" id="upld_form" enctype="multipart/form-data" method="POST">
                            <label for="input_file_xls" class="btn bg-cityb t5 "><i class="el el-upload floatL t3"></i> &nbsp; Bulk Upload</label>
                            <input type="file" id="input_file_xls" style="visibility:hidden;width: 150px;position:absolute;"  name="input_file_xls">
                        </form> 
                           <a href="<?=@$rfu_data['sample_url']?>" target="_blank" download>Sample</a>
                    </div>
                    <?php
                        }  
                    ?>
                    <?php echo form_open("", 'method="post" autocomplete="off" id="gcrud-search-form"'); ?>
                        <div class="header-tools <?=$rfu_data['export']?>">
                            <?php if(!$unset_add){?>
                                <div class="floatL t5">
                                    <a class="btn bg-cityb " href="<?php echo $add_url?>">
                                        <i class="el el-plus"></i> &nbsp; <?php echo $this->l('list_add'); ?> <?php echo $subject?>
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="floatR">
                                <?php if(!$unset_export && $rfu_data['export'] != "hide") { ?>
                                
                                    <a class="btn bg-cityb t5 gc-export" data-url="<?php echo $export_url; ?>" href="javascript:;">
                                        <i class="el el-share floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <?php echo $this->l('list_export');?>
                                        </span>
                                        <div class="clear"></div>
                                    </a>
                                <?php } ?>
                                <?php if(!$unset_print) { ?>
                                    <a class="btn bg-cityb t5 gc-print" data-url="<?php echo $print_url; ?>" href="javascript:;">
                                        <i class="el el-print floatL t3"></i>
                                        <span class="hidden-xs floatL l5">
                                            <?php echo $this->l('list_print');?>
                                        </span>
                                        <div class="clear"></div>
                                    </a>
                                <?php }?>

                              
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="scroll-if-required">
        			        <table class="table table-bordered1 table-striped grocery-crud-table table-hover">
        					<thead>
        						<tr>
        							
                                    <?php foreach($columns as $column){?>
                                        <th class="column-with-ordering" data-order-by="<?php echo $column->field_name; ?>"><?php echo $column->display_as; ?></th>
                                    <?php }?>
                                    <th colspan="2" <?php if ($buttons_counter === 0) {?>class="hidden"<?php }?>>
                                        <?php echo $this->l('list_actions'); ?>
                                    </th>
        						</tr>
        						

        					</thead>
        					<tbody>
                                <?php include(__DIR__."/list_tbody.php"); ?>
        					</tbody>
                            <tfoot>
                                <!-- search bar -->
                                <tr class="filter-row gc-search-row">
                                    
                                    <?php foreach($columns as $column){?>
                                        <td>
                                            <input
                                                type="text"
                                                class="form-control searchable-input floatL bg-cityg"
                                                placeholder="<?php echo str_replace('{column_name}', $column->display_as, $search_column_string); ?>"
                                                name="<?php echo $column->field_name; ?>" />
                                        </td>
                                    <?php }?>
                                    <td class="no-border-right <?php if ($buttons_counter === 0) {?>hidden<?php }?>">
                                        <?php if (!$unset_delete) { ?>
                                             <div class="floatL t5">
                                                 <input type="checkbox" class="select-all-none" />
                                             </div>
                                         <?php } ?>
                                     </td>
                                    <td class="no-border-left <?php if ($buttons_counter === 0) {?>hidden<?php }?>">
                                        <div class="floatL">
                                            <a href="javascript:void(0);" title="<?php echo $this->l('list_delete')?>"
                                               class="hidden btn btn-secondary btn-xs delete-selected-button">
                                                <i class="el el-remove text-danger"></i>
                                                <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                            </a>
                                        </div>
                                        <div class="floatR l5">
                                           <!--  <a href="javascript:void(0);" class="btn btn-secondary btn-xs gc-refresh">
                                                <i class="el el-refresh"></i>
                                            </a> -->
                                            <a href="javascript:void(0)" class="clear-filtering btn bg-cityg">
                                                            <i class="el el-eraser"></i> Clear
                                                        </a>
                                        </div>
                                        <div class="clear"></div>
                                    </td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>

                            <!-- Table Footer -->
        					<div class="footer-tools">

                                            <!-- "Show 10/25/50/100 entries" (dropdown per-page) -->
                                            <div class="floatL t20 l5">
                                                <div class="floatL t5">
                                                    <?php list($show_lang_string, $entries_lang_string) = explode('{paging}', $this->l('list_show_entries')); ?>
                                                    <?php echo $show_lang_string; ?>
                                                </div>
                                                <div class="floatL r5 l5">
                                                    <select name="per_page" class="per_page form-control">
                                                        <?php foreach($paging_options as $option){?>
                                                            <option value="<?php echo $option; ?>"
                                                                    <?php if($option == $default_per_page){?>selected="selected"<?php }?>>
                                                                        <?php echo $option; ?>&nbsp;&nbsp;
                                                            </option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                                <div class="floatL t5">
                                                    <?php echo $entries_lang_string; ?>
                                                </div>
                                                <div class="clear"></div>
                                            </div>
                                            <!-- End of "Show 10/25/50/100 entries" (dropdown per-page) -->


                                            <div class="floatR r5">

                                                <!-- Buttons - First,Previous,Next,Last Page -->
                                                <ul class="pagination">
                                                    <li class="disabled paging-first page-item">
                                                        <a href="javascript:;" class="page-link">
                                                            <i class="el el-step-backward"></i>
                                                        </a>
                                                    </li>
                                                    <li class="prev disabled paging-previous page-item">
                                                        <a href="javascript:;" class="page-link">
                                                            <i class="el el-chevron-left"></i>
                                                        </a>
                                                    </li>
                                                    <li class="page-item">
                                                        <span class="page-number-input-container page-link">
                                                            <input type="number" value="1" class="form-control page-number-input" />
                                                        </span>
                                                    </li>
                                                    <li class="next paging-next page-item">
                                                        <a href="#" class="page-link">
                                                            <i class="el el-chevron-right"></i>
                                                        </a>
                                                    </li>
                                                    <li class="paging-last page-item">
                                                        <a href="#" class="page-link">
                                                            <i class="el el-step-forward"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <!-- End of Buttons - First,Previous,Next,Last Page -->

                                                <input type="hidden" name="page_number" class="page-number-hidden" value="1" />

                                                <!-- Start of: Settings button -->
                                                <!-- <div class="btn-group floatR t20 l10 settings-button-container">
                                                    <button type="button" class="btn btn-secondary btn-xs settings-button gc-bootstrap-dropdown dropdown-toggle">
                                                        <i class="el el-cog r5"></i>
                                                        <span class="caret"></span>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="clear-filtering dropdown-item">
                                                            <i class="el el-eraser"></i> Clear filtering
                                                        </a>
                                                    </div>
                                                </div> -->
                                                <!-- End of: Settings button -->

                                            </div>


                                            <!-- "Displaying 1 to 10 of 116 items" -->
                                            <div class="floatR r10 displaying-paging-items">
                                                <?php echo $list_displaying; ?>
                                                <span class="full-total-container hidden">
                                                    <?php echo str_replace(
                                                                "{total_results}",
                                                                "<span class='full-total'>" . $this->get_total_results() . "</span>",
                                                                $this->l('list_filtered_from'));
                                                    ?>
                                                </span>
                                            </div>
                                            <!-- End of "Displaying 1 to 10 of 116 items" -->

                                            <div class="clear"></div>
                            </div>
                            <!-- End of: Table Footer -->

                    <?php echo form_close(); ?>
                </div>
        	</div>

            <!-- Delete confirmation dialog -->
            <div class="delete-confirmation modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><?php echo $this->l('list_delete'); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $this->l('alert_delete'); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal"><?php echo $this->l('form_cancel'); ?></button>
                            <button type="button" class="btn btn-danger delete-confirmation-button"><?php echo $this->l('list_delete'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Delete confirmation dialog -->

            <!-- Delete Multiple confirmation dialog -->
            <div class="delete-multiple-confirmation modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><?php echo $this->l('list_delete'); ?></h4>
                        </div>
                        <div class="modal-body">
                            <p><?php echo $this->l('alert_delete'); ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-xs" data-dismiss="modal">
                                <?php echo $this->l('form_cancel'); ?>
                            </button>
                            <button type="button" class="btn btn-danger delete-multiple-confirmation-button"
                                    data-target="<?php echo $delete_multiple_url; ?>">
                                <?php echo $this->l('list_delete'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Delete Multiple confirmation dialog -->

            </div>
        </div>

<script>
                            $("#input_file_xls").on("change",function(){
		if (confirm("Have you reffered sample file format & are you sure you want to upload this file?") == true) {
		  $("#upld_form").submit();
		} else {
		  $("#input_file_xls").val('');
		}
		
	});
                
                            </script>