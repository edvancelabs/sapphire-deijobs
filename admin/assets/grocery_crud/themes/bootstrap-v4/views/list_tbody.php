<?php
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

    $show_more_button  = $buttons_counter > 2 ? true : false;

    //The more lang string exists only in version 1.5.2 or higher
    $more_string =
        preg_match('/1\.(5\.[2-9]|[6-9]\.[0-9])/', Grocery_CRUD::VERSION)
            ? $this->l('list_more') : "More";

?>

<?php 
if(count($list) > 0){
    foreach($list as $num_row => $row){ ?>
    <tr>
        
        <?php foreach($columns as $column){?>
            <td>
                <?php echo $row->{$column->field_name} != '' ? $row->{$column->field_name} : '&nbsp;' ; ?>
            </td>
        <?php }?>
        <td <?php if ($unset_delete) { ?> style="border-right: none;"<?php } ?>
            <?php if ($buttons_counter === 0) {?>class="hidden"<?php }?>>
            <?php if (!$unset_delete) { ?>
                <input type="checkbox" class="select-row" data-id="<?php echo $row->primary_key_value; ?>" />
            <?php } ?>
        </td>
        <td <?php if ($unset_delete) { ?> style="border-left: none;"<?php } ?>
            <?php if ($buttons_counter === 0) {?>class="hidden"<?php }?>>
                <div class="only-desktops"  style="white-space: nowrap">
                    <?php if(!$unset_edit){?>
                        <a class="btn btn-info btn-xs" href="<?php echo $row->edit_url?>"><i class="el el-pencil"></i> <?php echo $this->l('list_edit'); ?></a>
                    <?php } ?>
                    <?php if (!empty($row->action_urls) || !$unset_read || !$unset_delete) { ?>

                        <?php if ($show_more_button) { ?>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs dropdown-toggle gc-bootstrap-dropdown">
                                    <?php echo $more_string; ?>
                                    <span class="caret"></span>
                                </button>

                                <div class="dropdown-menu">
                                    <?php
                                    if(!empty($row->action_urls)){
                                        foreach($row->action_urls as $action_unique_id => $action_url){
                                            $action = $actions[$action_unique_id];
                                            ?>
                                            <a href="<?php echo $action_url; ?>" class="dropdown-item">
                                                <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                            </a>
                                        <?php }
                                    }
                                    ?>
                                    <?php if (!$unset_read) { ?>
                                        <a href="<?php echo $row->read_url?>" class="dropdown-item">
                                            <i class="el el-eye-open"></i> <?php echo $this->l('list_view')?>
                                        </a>
                                    <?php } ?>
                                    <?php if (!$unset_delete) { ?>
                                        <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row dropdown-item">
                                            <i class="el el-remove text-danger"></i>
                                            <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } else {
                                if(!empty($row->action_urls)){
                                    foreach($row->action_urls as $action_unique_id => $action_url){
                                        $action = $actions[$action_unique_id];
                                        ?>
                                        <a href="<?php echo $action_url; ?>" class="btn btn-secondary btn-xs">
                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                        </a>
                                    <?php }
                                }

                                if (!$unset_read) { ?>
                                    <a class="btn btn-info btn-xs" href="<?php echo $row->read_url?>"><i class="el el-eye-open"></i> <?php echo $this->l('list_view')?></a>
                                <?php }

                                if (!$unset_delete) { ?>
                                    <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row btn btn-secondary btn-xs">
                                        <i class="el el-remove text-danger"></i>
                                        <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                    </a>
                                <?php } ?>
                            <?php } ?>

                    <?php } ?>
                </div>
                <div class="only-mobiles">
                    <?php if ($buttons_counter > 0) { ?>
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-secondary btn-xs gc-bootstrap-dropdown dropdown-toggle">
                            <?php echo $this->l('list_actions'); ?>
                            <span class="caret"></span>
                        </button>
                        <div class="dropdown-menu">
                            <?php if (!$unset_edit) { ?>
                                <a href="<?php echo $row->edit_url?>" class="dropdown-item">
                                    <i class="el el-pencil"></i> <?php echo $this->l('list_edit'); ?>
                                </a>
                            <?php } ?>
                            <?php
                            if(!empty($row->action_urls)){
                                foreach($row->action_urls as $action_unique_id => $action_url){
                                    $action = $actions[$action_unique_id];
                                    ?>
                                        <a href="<?php echo $action_url; ?>" class="dropdown-item">
                                            <i class="fa <?php echo $action->css_class; ?>"></i> <?php echo $action->label?>
                                        </a>
                                <?php }
                            }
                            ?>
                            <?php if (!$unset_read) { ?>
                                <a href="<?php echo $row->read_url?>" class="dropdown-item">
                                    <i class="el el-eye-open"></i> <?php echo $this->l('list_view')?>
                                </a>
                            <?php } ?>
                            <?php if (!$unset_delete) { ?>
                                <a data-target="<?php echo $row->delete_url?>" href="javascript:void(0)" title="<?php echo $this->l('list_delete')?>" class="delete-row dropdown-item">
                                    <i class="el el-remove text-danger"></i> <span class="text-danger"><?php echo $this->l('list_delete')?></span>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
        </td>
    </tr>
<?php 
    }
}else{
    echo "<tr><td colspan='".(count($columns)+2)."' class='text-center'>No Data</td></tr>";
}
 ?>
