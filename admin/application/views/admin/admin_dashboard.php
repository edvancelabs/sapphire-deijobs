<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once( 'includes/head.php'); ?>
    <!-- <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/admin/css/dashboard.css"> -->
    <script src="<?=base_url()?>assets/grocery_crud/js/jquery-2.2.4.min.js"></script>
    <style>
        .card{
            border-radius: 1rem;
            overflow: hidden;
            border:none;
        }
        .dash_chart{
            width:100%;
            height:200px;
        }
        .card-header{
            background-color:#fff;
        }
    </style>        

</head>

<body>

    <section id="container">
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <!-- <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div> -->
            </div>
            <!--logo start-->
            <a href="javascript:void(0);" class="logo"><b class="page-header-logo">Dashboard</b></a>
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
            <?php include_once( 'includes/sidebar_admin.php'); ?>
        </aside>
        <!--sidebar end-->

        <!--main content start-->
        <section id="main-content">

            <section class="wrapper site-min-height px-5">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                          <div class="card-header text-dark">
                            Recent Settlements
                          </div>
                          <div class="card-body">
                            <h5 class="card-title">₹<?=$rec_sett['amount']?></h5>
                            <footer><?=$rec_sett['date_added']?></footer>
                            <!-- <footer>Settled on 18 March 2023</footer> -->
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                          <div class="card-header text-dark">
                            Open Disputes
                          </div>
                          <div class="card-body">
                            <h5 class="card-title">₹0.00</h5>
                            <footer>Dispute Amount</footer>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                          <div class="card-header text-dark">
                            Suspecious Transactions
                          </div>
                          <div class="card-body">
                            <h5 class="card-title">₹0.00</h5>
                            <footer>Suspecious Amount</footer>
                          </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-5">
                    <!-- <div class="col-sm-4">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px;width: 100%" class="bg-cityb">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span> <i class="fa fa-caret-down"></i>
                        </div>
                    </div> -->
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header text-dark">
                            Total Transactions <span id="txn_cnt">00</span>
                          </div>
                          <div class="card-body">
                            <h5 class="card-title">Transaction Amount ₹<span id="txn_amt">0.00</span></h5>
                            <div class="dash_chart1">
                                <canvas id="myChartTotal" style="width:100%;max-width:700px"></canvas>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header text-dark">
                            Total Refunds <span id="rfnd_cnt">00</span>
                          </div>
                          <div class="card-body">
                            <h5 class="card-title">Refund Amount ₹<span id="rfnd_amt">0.00</span></h5>
                            <div class="dash_chart1">
                                <canvas id="myChartRef" style="width:100%;max-width:700px"></canvas>
                            </div>
                          </div>
                        </div>
                    </div>
                </div> 
                 <div class="row mt-4">                
                    <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header text-dark">
                            Average Transaction Value
                          </div>
                          <div class="card-body">
                            <!-- <h5 class="card-title">Refund Amount ₹0.00</h5> -->
                            <div class="dash_chart1">
                                <canvas id="myChartAvg" style="width:100%;max-width:700px"></canvas>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                          <div class="card-header text-dark">
                            Preferred Payment Method
                          </div>
                          <div class="card-body">
                            <!-- <h5 class="card-title">Refund Amount ₹0.00</h5> -->
                            <div class="dash_chart1">
                                <canvas id="myChartMethod" style="width:100%;max-width:700px;margin:0 auto;"></canvas>
                            </div>
                          </div>
                        </div>
                    </div>
                </div> 
                       
                
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->

        <!--main content end-->
    </section>

    <?php include_once( 'includes/site_bottom_scripts.php'); ?>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>


    <script>
    $('.sidebar-menu li a').removeClass('active');
    $('#menu_dashboard').addClass('active');
    // var start = moment().startOf('day');
    // var end = moment();

    // function cb(start, end) {
    //     $('#reportrange span').html(start.format('MMM D, YYYY (HH:mm)') + ' - ' + end.format('MMM D, YYYY (HH:mm)'));
    // }

    // var abc = $('#reportrange').daterangepicker({
    //     timePicker: true,
    //     timePicker24Hour: true,
    //      "timePickerIncrement": 5,
    //     startDate: start,
    //     endDate: end,
    //     ranges: {
    //        'Today': [moment().startOf('day'), moment()],
    //        'Yesterday': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
    //        'Last 7 Days': [moment().subtract(6, 'days').startOf('day'), moment()],
    //        'Last 30 Days': [moment().subtract(29, 'days').startOf('day'), moment()],
    //        'This Month': [moment().startOf('month').startOf('day'), moment().endOf('month')],
    //        'Last Month': [moment().subtract(1, 'month').startOf('month').startOf('day'), moment().subtract(1, 'month').endOf('month')]
    //     },
    //      "locale": {
    //             "format": "YYYY-MM-DD HH:mm",
    //         }
    // }, cb);


    // cb(start, end);


    // $('#reportrange').on('apply.daterangepicker', function(ev, picker) {

    //     $("#custom_search_startdate_range").val(picker.startDate.format('YYYY-MM-DD HH:mm')+":00");
    //     $("#custom_search_enddate_range").val(picker.endDate.format('YYYY-MM-DD HH:mm')+":00");
    // });



// var data = [{"cnt":"1","y":"11.200000","x":"2023-03-07"},{"cnt":"1","y":"11.200000","x":"2023-03-10"},{"cnt":"1","y":"12.200000","x":"2023-03-11"}];

$.ajax({
    url: '<?=base_url()?>admin/dashboard_chart_data',  
})
.done(function(res) {
    res = JSON.parse(res);
    create_charts(res.data,res.refundData,res.type);
})
.fail(function() {
    console.log("error");
})
.always(function() {
    console.log("complete");
});






function create_charts(data,refData,type){
    // var data = [{"cnt":"1","amt":"11.20","y":"11.200000","x":"6"},{"cnt":"1","amt":"12.20","y":"12.200000","x":"7"}];
    // var data = data;

    // var type = 'HR';
    var new_data = [];

    var txn_cnt = 0;
    var txn_amt = 0;

    if(type == 'HR'){
       for (var i = 0; i < 12; i++) {
            var a = "";
            var labl = (i*2)+'-'+((i*2)+1)+'Hr';
            $.each(data,function(index, el) {
                if(el.x == i){
                    a = el;
                    a.x = labl;
                    txn_cnt = txn_cnt + parseFloat(a.cnt);
                    txn_amt = txn_amt + parseFloat(a.amt);
                }            
            });

           if(a){
                new_data.push(a);
           }else{
                new_data.push({"cnt":"0","y":"0","x":labl});
           }
       }
       $("#txn_cnt").text(txn_cnt);
       $("#txn_amt").text(txn_amt);
       const configAvg = {
              type: 'line',
              data: {
                datasets: [{
                  data: new_data,
                  label: "₹",
                  borderColor: '#0d27ff',
                  tension: 0.5
                }]
              },
              options: {
                scales: {
                    y:{
                        grid:{
                            display:false
                        },
                        beginAtZero: true
                    },
                    x:{
                        grid:{
                            display:false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 48
                        }
                    }
                }
              }
            }

        if(data.length == 0){
            configAvg.options.scales.y.display = false;
        }
        let configTotal = configAvg;        
        new Chart("myChartAvg", configAvg);
        
        configTotal.type = 'bar';
        configTotal.data.datasets[0].backgroundColor = ['#0d27ff'];
        configTotal.data.datasets[0].borderRadius = 10;
        configTotal.options.parsing = {
            yAxisKey: 'amt'
        }
        new Chart("myChartTotal", configTotal);
    }

    // var refData = [{"cnt":"1","y":"1.10","x":"6"},{"cnt":"2","y":"2.40","x":"7"}];
    var refType = 'HR';
    var refNew_data = [];
    var rfnd_cnt = 0;
    var rfnd_amt = 0;

    if(type == 'HR'){
       for (var i = 0; i < 12; i++) {
            var a = "";
            var labl = (i*2)+'-'+((i*2)+1)+'Hr';
            $.each(refData,function(index, el) {
                if(el.x == i){
                    a = el;
                    a.x = labl;
                    rfnd_cnt = rfnd_cnt + parseFloat(a.cnt);
                    rfnd_amt = rfnd_amt + parseFloat(a.y);
                }            
            });

           if(a){
                refNew_data.push(a);
           }else{
                refNew_data.push({"cnt":"0","y":"0","x":labl});
           }
       }
        $("#rfnd_cnt").text(rfnd_cnt);
        $("#rfnd_amt").text(rfnd_amt);
       const configRef = {
              type: 'bar',
              data: {
                datasets: [{
                  data: refNew_data,
                  label: "₹",
                  backgroundColor: '#0d27ff',
                  borderRadius: 10
                }]
              },
              options: {
                scales: {
                    y:{
                        grid:{
                            display:false
                        },
                        beginAtZero: true
                    },
                    x:{
                        grid:{
                            display:false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
              }
            }
       
        
        if(refData.length == 0){
            configRef.options.scales.y.display = false;
        }
        new Chart("myChartRef", configRef);
    }

}



const configMethod = {
  type: 'doughnut',
  data: {
            datasets: [{
              data: [100],
              backgroundColor: [
                  '#0d27ff',
                  '#f85a40'
                ],
            }],
            labels: [
                'UPI',
                // 'Net Banking'
            ]
        },
    options: {
    responsive: true,
    title: {
      display: false,
      position: "center",
      fontStyle: "bold",
      fontSize: 0,
      fullWidth: false,
      padding: 0
    },
    plugins: {
            legend: {
                position: 'top'
            }
        }
  }

};
var myChartMethod = new Chart("myChartMethod", configMethod);
myChartMethod.canvas.parentNode.style.height = '250px';






// new Chart("myChart", {
//   type: "line",
//   data: {
//     // labels: xValues,
//     datasets: [{
//       fill: false,
//       lineTension: 0,
//       backgroundColor: "rgba(0,0,255,1.0)",
//       borderColor: "rgba(0,0,255,0.1)",
//       data: data,
//     }]
//   },
//   options: {
//     legend: {display: false},
//     plugins: {
//       title: {
//         text: 'Chart.js Time Scale',
//         display: true
//       }
//     },
//     scales: {
//       yAxes: {display:false},
//       xAxes: {
//                 //gridLines:"rgba(0,0,0)",
//                 type: 'time',
//                 time: {
//                     unit: 'day',
//                     // displayFormats: {
//                     //   hour: 'YYYY-MM-DD'
//                     // }
//                 },
//                 min:1,
//                 max:24,
//                 // adapters: { 
//                 //     date: {
//                 //       locale: 'enUS', 
//                 //     },
//                 //   }, 
//             },

//     }
    
//   }
// });
  </script>

</body>

</html>