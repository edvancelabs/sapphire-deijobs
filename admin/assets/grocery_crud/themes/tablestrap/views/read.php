<?php $this->set_css($this->default_theme_path.'/tablestrap/css/bootstrap.min.css');?>
<?php $this->set_css($this->default_theme_path.'/tablestrap/css/bootstrap-theme.min.css');?>

<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title"><?php echo $this->l('list_record'); ?> <?php echo $subject?></h3>
  	</div>

	<!-- Start of hidden inputs -->
		<?php
			foreach($hidden_fields as $hidden_field){
				echo $hidden_field->input;
			}
		?>
	<!-- End of hidden inputs -->
	<?php if ($is_ajax) { ?><input type="hidden" name="is_ajax" value="true" /><?php }?>
	<div class='line-1px'></div>
	<div id='report-error' class='report-div error'></div>
	<div id='report-success' class='report-div success'></div>

	<div class="table-responsive">
		<table class="table table-striped">
			<?php foreach ($fields as $field){ ?>
				<tr class='form-field-box' id="<?php echo $field->field_name; ?>_field_box">
					<th class='form-display-as-box' style="width:25% !important;" id="<?php echo $field->field_name; ?>_display_as_box">
						<?php echo $input_fields[$field->field_name]->display_as . 
						($input_fields[$field->field_name]->required ? "*" : ""); ?>
					</th>
					<td class='form-input-box' id="<?php echo $field->field_name; ?>_input_box">
						<?php echo $input_fields[$field->field_name]->input?>
					</td>
				</tr>
			<?php } ?>
		</table>
	</div>
	<div class="panel-footer">
    	<a href="<?php echo $list_url?>" class="btn bg-cityg">
			<?php echo $this->l('form_back_to_list'); ?>
		</a>

		<?php
			if(@$rfu_data['get_txns_btn']){				
		?>
		<a href="#" id="get_txns_btn" class="btn bg-cityg ml-5">
			View Transactions 
		</a>
		<div class="right_pannel">
			<div class="p-2"><a href="#" id="close_pannel"><i class="fa fa-close"></i></a></div>
			<div id="txn_list" >
			</div>
		</div>
		<script>

			
			$(document).on('click', '#close_pannel', function(event) {
				$(".right_pannel").hide();
			});
			$(document).on('click', '#get_txns_btn', function(event) {
				$("#txn_list").html('');
				$(".right_pannel").show();
				event.preventDefault();
				$.ajax({
					url: '<?=base_url()?>admin/getSettlemtTxns/<?=$input_fields['id']->input?>',
					
				})
				.done(function(res) {
					data = JSON.parse(res);
					$.each(data,function(index, el) {
						$("#txn_list").append('<div class="list-group-item mb-0"><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">'+el.amount+'</h5><small>'+el.date_added+'</small></div><small class="text-muted">'+el.reference_id+'</small></div>');
					});
					
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
			});
			
			
		</script>
		<?php		
			}
		?>
  	</div>
</div>