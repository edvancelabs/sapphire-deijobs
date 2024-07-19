<style>
	.badge-pending{color: #000;background-color: #ffc107;}
	.badge-processing{color: #fff;background-color: #17a2b8;}
	.badge-processed{color: #fff;background-color: #28a745;}
	.badge-Rejected{color: #fff;;background-color: #dc3545;}
	.badge-Queued{color: #fff;background-color: #6c757d;}
	.badge-Cancelled{color: #fff;background-color: #dc3545;}
	.badge-Reversed{color: #fff;background-color: #007bff;}
</style>

<?php 
if($rfu_data['show_filters'] && $rfu_data['admin'] == "admin"){	
?>
<form action="" id="cst_filter_form" >
<div class="row custom_filters">	
	<div class="col-sm-3">
		<select name="merchant_id" class="search_merchant_id w100" id="custom_search_merchant_id" style="height: 32px;width: 100%;">
			<option value="">All Merchants</option>
			<?php
			// print_r($rfu_data['merchants']);exit;
				foreach ($rfu_data['merchants'] as $key => $value) {
					echo "<option vlaue='".$value['merchant_id']."'>".sprintf("%06d", $value['merchant_id'])."</option>";
				}
			?>
		</select>
	</div>
	<div class="col-sm-3">
		<select name="status" class="search_settlement_status w100" id="custom_search_settlement_status" style="height: 32px;width: 100%;">
			<option value="all">ALL Status</option>
			<option value="pending">Pending</option>
			<option value="processing">Processing</option>
			<option value="processed">Processed</option>
			<option value="rejected">Rejected</option>
			<option value="queued">Queued</option>
			<option value="cancelled">Cancelled</option>
			<option value="reversed">Reversed</option>
		</select>
	</div>	
	<div class="col-sm-5">
		<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #000; width: 100%">
		    <i class="fa fa-calendar"></i>&nbsp;
		    <span></span> <i class="fa fa-caret-down"></i>
		</div>
		<input type="hidden" name="start_date" id="custom_search_startdate_range">
		<input type="hidden" name="end_date" id="custom_search_enddate_range">
	</div>
	<div class="col-sm-1">
		<input type="hidden" id="dwn_settlemt_input" name="dwn_advice" >
		<button  style="height: 32px;width: 100%;" class="btn btn-info">Filter</button>
	</div>	
	
	
</div>
</form>
<div class="row mt-3">
	<div class="col-sm-6 ">
		<table class="table border bg-white">
			<thead>
				<tr>
					<th>Merchant ID</th>
					<th>Total Transactions</th>
					<th>Total Amount</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$all_amt = 0;
					$all_txn = 0;
	                 foreach ($rfu_data['tbl'] as $key => $value) {
	                 	echo "<tr><td>".sprintf("%06d", $value->merchant_id)."</td><td>".$value->total_txn."</td><td>".$value->total_amt."</td><td><span class='badge badge-$value->settlement_status'>".$value->settlement_status."</span></td></tr>";
	                 	$all_amt = $all_amt + $value->total_amt;
	                 	$all_txn = $all_txn + $value->total_txn;


	                 }
				?>
				<tr>
					<th>Total</th>
					<th><?=$all_txn?></th>
					<th><?=$all_amt?></th>
				</tr>

			</tbody>
		</table>
	</div>
	<div class="col-sm-6">
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<button id="dwn_settlement" class="btn btn-primary">Download Settlement Advice</button>
					</div>
					<div class="col-sm-6">
						<form action="" id="upld_form" enctype="multipart/form-data" method="POST">
							<label for="input_file_xls" class="btn  btn-primary">Upload Settlement Update</label>
							<input type="file" id="input_file_xls" style="visibility:hidden;"  name="input_file_xls">
						</form>
					</div>
				</div>
				
				<!-- <button id="upld_settlement">Upload Settlement Update</button> -->
				

			</div>
		</div>
	</div>
</div>
<?php
}else if($rfu_data['show_filters'] && $rfu_data['admin'] == "merchant"){
?>
<form action="" id="cst_filter_form" >
<div class="row custom_filters">
	<div class="col-sm-3">
		<select name="status" class="search_settlement_status w100" id="custom_search_settlement_status" style="height: 32px;width: 100%;">
			<option value="all">ALL Status</option>
			<option value="pending">Pending</option>
			<option value="processing">Processing</option>
			<option value="processed">Processed</option>
			<option value="rejected">Rejected</option>
			<option value="queued">Queued</option>
			<option value="cancelled">Cancelled</option>
			<option value="reversed">Reversed</option>
		</select>
	</div>	
	<div class="col-sm-5">
		<div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #000; width: 100%">
		    <i class="fa fa-calendar"></i>&nbsp;
		    <span></span> <i class="fa fa-caret-down"></i>
		</div>
		<input type="hidden" name="start_date" id="custom_search_startdate_range">
		<input type="hidden" name="end_date" id="custom_search_enddate_range">
	</div>
	<div class="col-sm-1">
		<input type="hidden" id="dwn_settlemt_input" name="dwn_advice" >
		<button  style="height: 32px;width: 100%;" class="btn btn-info">Filter</button>
	</div>		
</div>
</form>

<?php
}
?>


<table cellpadding="0" cellspacing="0" border="0" class="display groceryCrudTable" id="<?php echo uniqid(); ?>">
	<thead>
		<tr>
			<?php foreach($columns as $column){?>
				<th><?php echo $column->display_as; ?></th>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<th class='actions'><?php echo $this->l('list_actions'); ?></th>
			<?php }?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($list as $num_row => $row){ ?>
		<tr id='row-<?php echo $num_row?>'>
			<?php foreach($columns as $column){?>
				<td><?php echo $row->{$column->field_name}?></td>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
			<td class='actions'>
				<?php
				if(!empty($row->action_urls)){
					foreach($row->action_urls as $action_unique_id => $action_url){
						$action = $actions[$action_unique_id];
				?>
						<a href="<?php echo $action_url; ?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
							<span class="ui-button-icon-primary ui-icon <?php echo $action->css_class; ?> <?php echo $action_unique_id;?>"></span><span class="ui-button-text">&nbsp;<?php echo $action->label?></span>
						</a>
				<?php }
				}
				?>
				<?php if(!$unset_read){?>
					<a href="<?php echo $row->read_url?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
						<span class="ui-button-icon-primary ui-icon ui-icon-document"></span>
						<span class="ui-button-text">&nbsp;<?php echo $this->l('list_view'); ?></span>
					</a>
				<?php }?>

                <?php if(!$unset_clone){?>
                    <a href="<?php echo $row->clone_url?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
                        <span class="ui-button-icon-primary ui-icon ui-icon-copy"></span>
                        <span class="ui-button-text">&nbsp;<?php echo $this->l('list_clone'); ?></span>
                    </a>
                <?php }?>

				<?php if(!$unset_edit){?>
					<a href="<?php echo $row->edit_url?>" class="edit_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
						<span class="ui-button-icon-primary ui-icon ui-icon-pencil"></span>
						<span class="ui-button-text">&nbsp;<?php echo $this->l('list_edit'); ?></span>
					</a>
				<?php }?>

				<?php if(!$unset_delete){?>
					<a onclick = "javascript: return delete_row('<?php echo $row->delete_url?>', '<?php echo $num_row?>')"
						href="javascript:void(0)" class="delete_button ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary" role="button">
						<span class="ui-button-icon-primary ui-icon ui-icon-circle-minus"></span>
						<span class="ui-button-text">&nbsp;<?php echo $this->l('list_delete'); ?></span>
					</a>
				<?php }?>
			</td>
			<?php }?>
		</tr>
		<?php }?>
	</tbody>
	<tfoot>
		<tr>
			<?php foreach($columns as $column){?>
				<th><input type="text" name="<?php echo $column->field_name; ?>" placeholder="<?php echo $this->l('list_search').' '.$column->display_as; ?>" class="search_<?php echo $column->field_name; ?>" /></th>
			<?php }?>
			<?php if(!$unset_delete || !$unset_edit || !$unset_read || !empty($actions)){?>
				<th style="padding: 5px;">
					<!-- <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only floatR refresh-data" role="button" data-url="<?php echo $ajax_list_url; ?>">
						<span class="ui-button-icon-primary ui-icon ui-icon-refresh"></span><span class="ui-button-text">&nbsp;</span>
					</button> -->
					<a href="javascript:void(0)" role="button" class="clear-filtering ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary floatR">
						<span class="ui-button-icon-primary ui-icon ui-icon-arrowrefresh-1-e"></span>
						<span class="ui-button-text">Clear Filter</span>
					</a>
				</th>
			<?php }?>
		</tr>
	</tfoot>
</table>

<?php 
if($rfu_data['show_filters']){
?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
$(function() {

    // var start = moment().subtract(29, 'days');
    var start = moment().startOf('day');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMM D, YYYY (HH:mm)') + ' - ' + end.format('MMM D, YYYY (HH:mm)'));
    }

    var abc = $('#reportrange').daterangepicker({
    	timePicker: true,
    	timePicker24Hour: true,
    	 "timePickerIncrement": 5,
        startDate: start,
        endDate: end,
        ranges: {
           'Today': [moment().startOf('day'), moment()],
           'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
           'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days').startOf('day'), moment()],
           'This Month': [moment().startOf('month').startOf('day'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month')]
        },
         "locale": {
		        "format": "YYYY-MM-DD HH:mm",
		    }
    }, cb);


    cb(start, end);


    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
	  	// console.log(picker.startDate.format('YYYY-MM-DD'));
	  	// console.log(picker.endDate.format('YYYY-MM-DD'));


	 //  	chosen_table = datatables_get_chosen_table($('.groceryCrudTable'));

		// chosen_table.fnFilter( $(this).val(), 4 );

		$("#custom_search_startdate_range").val(picker.startDate.format('YYYY-MM-DD HH:mm')+":00");
		$("#custom_search_enddate_range").val(picker.endDate.format('YYYY-MM-DD HH:mm')+":00");
	});


    function getParameterByName(name, url = window.location.href) {
	    name = name.replace(/[\[\]]/g, '\\$&');
	    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
	        results = regex.exec(url);
	    if (!results) return null;
	    if (!results[2]) return '';
	    return decodeURIComponent(results[2].replace(/\+/g, ' '));
	}
	
	if(getParameterByName('merchant_id')){
		$("#custom_search_merchant_id").val(getParameterByName('merchant_id'));
	}
	if(getParameterByName('status')){
		$("#custom_search_settlement_status").val(getParameterByName('status'));
	}else{
		$("#custom_search_settlement_status").val("pending");
	}
	$("#dwn_settlement").parent().hide();
	if($("#custom_search_settlement_status").val() == "pending"){
		$("#dwn_settlement").parent().show();
	}


	var months = ['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec' ];

	if(getParameterByName('start_date')){
		var date12 = getParameterByName('start_date');
		// start = date12.split(" ")[0]
		start = date12;
		$("#custom_search_startdate_range").val(start);
		console.log(start);
		$('#reportrange').data('daterangepicker').setStartDate(start);
		start = date12.split(" ")[0]
		start = start.split("-");

		start = months[start[1]-1]+" "+start[2]+", "+start[0]+" ("+date12.split(" ")[1]+")";


	}	

	if(getParameterByName('end_date')){
		var date12 = getParameterByName('end_date');
		// var end = date12.split(" ")[0]
		var end = date12;

		$("#custom_search_enddate_range").val(end);
		console.log(end);
		$('#reportrange').data('daterangepicker').setEndDate(end);
		end = date12.split(" ")[0]
		end = end.split("-");

		end = months[end[1]-1]+" "+end[2]+", "+end[0]+" ("+date12.split(" ")[1]+")";
		
		$('#reportrange span').html(start + ' - ' + end);

	}


	$("#dwn_settlement").on("click",function(){
		// if($("#custom_search_settlement_status").val() != "pending"){
		// 	$("#custom_search_settlement_status").val("pending");
		// }
		$("#custom_search_settlement_status").val("pending");
		$("#dwn_settlemt_input").val(1);
		$("#cst_filter_form").submit();
		// setTimeout(function(){
		// 	location.reload();
		// },1000);
		

	});

	$("#input_file_xls").on("change",function(){
		if (confirm("upload this update file?") == true) {
		  $("#upld_form").submit();
		} else {
		  $("#input_file_xls").val('');
		}
		
	});
	


});

</script>
<?php
}
?>
