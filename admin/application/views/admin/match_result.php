<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('includes/head.php'); ?>


    <style type="text/css">
        
        #field-desc{

            width: 500px;
            height: 200px;
        }
        
        #credits_input_box input{
        	width:200px;
        	margin-right:10px;
        }
        
        .delete_me{
        	color:red !important;
        }
        .new_fiels_container{
            margin-bottom: 10px;

        }
    </style>


</head>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">

                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?=base_url()?>auth/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </header>
        <!--header end-->

        <!--sidebar start-->
        <aside>
            <?php include_once( 'includes/sidebar.php'); ?>
        </aside>
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <h1 class="page-header"><?=str_replace('_', " ", $this->uri->segment(2, 0))?></h1>
                <hr>
                <div class="row mt">
                    <div class="col-lg-8">
                        <form action="<?=base_url()?>admin/save_match_result" method="post" id="frm">
                          <div class="form-group">
                            <label for="match_id">Match</label>
                            <select name="match_id" id="match_id" required>
                                <option value="">Select</option>
                                <?php
                                    foreach ($fixtures as $k => $v) {
                                        echo "<option data-teams='".$v->team1.",".$v->team2."' value='".$v->id."'>".$v->name." (".$v->venue.") : ".$v->date_time."</option>";
                                    }
                                ?>                                
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="q_1">Winner of the match</label>
                            <select name="question[]" id="q_1" required>
                                <option value=""></option>
                                
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="q_2">Man of the match</label>
                            <select name="question[]" id="q_2" required>
                                <option value=""></option>
                                
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="opt3">Maximum number of sixes</label>
                            <input type="text" name="question[]" class="form-control" id="opt3" required>
                          </div>
                          <div class="form-group">
                            <label for="opt4">Maximum no. of wickets</label>
                            <input type="text" name="question[]" class="form-control" id="opt4" required>
                          </div>
                            
                          <button type="submit" class="btn btn-default">Save</button>
                        </form>


                        <button type="button" id="update_points" data-match_id="" class="btn btn-default">Update User Points</button>

                    </div>
                </div>
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>

        <!-- } -->
  <script src="<?=base_url()?>assets/front/js/jquery.min.js"></script>
    <?php include_once( 'includes/site_bottom_scripts.php'); ?> 

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

<script >
    $('#frm').ajaxForm(function(data) { 
      alert(data);      
    }); 
    



    // function countChar(val) {
    //     var len = val.value.length;
    //     if (len >= 140) {
    //       val.value = val.value.substring(0, 140);
    //     } else {
    //       $('#charNum').text(140 - len);
    //     }
    //   };
    $("#update_points").on("click",function(){
        $.ajax({
            url: '<?=base_url()?>admin/update_match_points/'+$(this).data('match_id'),
        })
        .done(function(res) {
            console.log(res);
            alert("Updated successfully");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    });

    $("#match_id").on("change",function(){
        var match_id = $(this).val();
        $("#update_points").data('match_id',match_id);
        var teams = $(this).find('option:selected').data('teams');
        console.log(teams);

        $.ajax({
          url: '<?=base_url()?>home/get_teams/'+teams,      
        })
        .done(function(res) {
          data = JSON.parse(res);
          if(data){
            
            $.each(data.teams, function(index, val) {
                
                $('#q_1').append('<option value="'+val[0].team_id+'">'+val[0].team_name+'</option>');

                $.each(val, function(i, v) {

                    $('#q_2').append('<option value="'+v.player_id+'">'+v.name+'</option>');
                                
                });
               
            });
            // console.log(teams);
          }


          $.ajax({
            url: '<?=base_url()?>admin/get_match_result/'+match_id,                    
          })
          .done(function(res) {
                data = JSON.parse(res);
                if(data && data.answers){
                    $.each(data.answers, function(index, val) {
                        if(val.question_id == "1"){
                            console.log(val.answer);
                            $("#q_1").val(val.answer);
                        }
                        if(val.question_id == "2"){
                            $("#q_2").val(val.answer);
                        }
                        if(val.question_id == "3"){
                            $("#opt3").val(val.answer);
                        }

                        if(val.question_id == "4"){
                            $("#opt4").val(val.answer);
                        }
                    });
                    
                }
              console.log("success");
          })
          .fail(function() {
              console.log("error");
          })
          .always(function() {
              console.log("complete");
          });
          
          console.log("success");
        })
        .fail(function() {
          console.log("error");
        })
        .always(function() {
          console.log("complete");
        });
        // $.ajax({
        //     url: '<?=base_url()?>admin/get_match_results/'+$(this).val(),            
        // })
        // .done(function(res) {
        //     data = JSON.parse(res);
        //     if(data.code){
        //         $.each(data.option, function(index, val) {
        //             $("#opt"+(index+1)).val(val);
        //         });
        //         $("#is_answer").val(data.is_answer);
        //     }else{
        //         $.each([1,2,3,4], function(index, val) {
        //             $("#opt"+(index+1)).val('');
        //         });
        //         $("#is_answer").val('');
        //     }
        //     console.log("success");
        // })
        // .fail(function() {
        //     console.log("error");
        // })
        // .always(function() {
        //     console.log("complete");
        // });
        
    });
</script>

</html>