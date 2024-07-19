
          <div id="sidebar"  class="nav-collapse " style="z-index:9999">
              <ul class="sidebar-menu" id="nav-accordion">

                  <li>
                    <h1 class="centered" style="color:white;margin: 35px 0;">
                        <img src="<?=base_url()?>assets/images/logo.png" style=" width:180px;">
                        <!-- Kup Cake -->
                    </h1>
                  </li>
                  <li class="side_user_name">
                    <a href="#" >
                      <!-- <span class="user_initial">A</span> -->
                      <span>Test Account</span>
                    </a>

                  </li>
                  <!-- <li class="sub-menu">
                      <a href="javascript:void(0);" id="menu_orders" >
                          <i class="fa fa-dashboard"></i>
                          <span>Styling</span>
                      </a>
                        <ul class="sub">
                          <li><a href="<?=base_url()?>admin/Styling"> Styling Details</a></li>
                          <li><a href="<?=base_url()?>admin/styling_Slider">Styling Slider</a></li>
                          
                      </ul>
                  </li> -->

                  <li >
                      <a href="<?=base_url()?>merchant" class="" id="menu_dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  
                  <li >
                      <a href="<?=base_url()?>merchant/profile" class="" id="menu_profile">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>
                <li >
                      <a href="<?=base_url()?>merchant/payin_transactions" class="" id="menu_payin_transactions">
                          <i class="fa fa-book"></i>
                          <span>Payments</span>
                      </a>
                  </li>
                  <li >
                      <a href="<?=base_url()?>merchant/refund_transactions" class="" id="menu_refund_transactions">
                          <i class="fa fa-undo"></i>
                          <span>Refunds</span>
                      </a>
                  </li>

                  

                  <li class="sub-menu">
                      <a href="javascript:void(0);" id="menu_orders" >
                          <i class="fa fa-rocket"></i>
                          <span>Payout</span>
                      </a>
                        <ul class="sub">
                          <li >
                              <a href="<?=base_url()?>merchant/contacts" class="" id="menu_contacts">
                                  <i class="fa fa-user"></i>
                                  <span>Contacts</span>
                              </a>
                          </li>
                          
                          <li >
                              <a href="<?=base_url()?>merchant/fund_accounts" class="" id="menu_fund_accounts">
                                  <i class="fa fa-book"></i>
                                  <span>Fund Accounts</span>
                              </a>
                          </li>

                          <li >
                              <a href="<?=base_url()?>merchant/payout_transactions" class="" id="menu_payout_transactions">
                                  <i class="fa fa-book"></i>
                                  <span>Payout Txns</span>
                              </a>
                          </li>
                          
                      </ul>
                  </li>

                  

                  
                  <li class="sub-menu">
                      <a href="javascript:void(0);" id="menu_developers" class="main_a">
                          <i class="fa fa-cogs"></i>
                          <span>Developers</span>
                      </a>
                        <ul class="sub">
                          <li><a id="menu_signatures" href="<?=base_url()?>developers/signatures">Signature</a></li>
                         <li><a id="menu_generate_signature" href="<?=base_url()?>developers/generate_signature">Generate Signature</a></li>
                          <li><a id="menu_payin_api_doc" href="<?=base_url()?>developers/payin_api_doc">Payment API</a></li>
                      </ul>
                  </li>                      
              </ul>
          </div>
          <script>
            $(document).ready(function() {
              $('.sidebar-menu li a').removeClass('active');
              $('#menu_<?=strtolower($this->uri->segment(2, 0))?>').addClass('active');
              $('#menu_<?=strtolower($this->uri->segment(2, 0))?>').parents('.sub-menu').children('.main_a').addClass('active');
            });
            
          </script>
