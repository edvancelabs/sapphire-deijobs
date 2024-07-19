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
                     <!--  <span class="user_initial">A</span>
                      <span>Admin</span> -->
                    </a>

                  </li>
                  <li >
                      <a href="<?=base_url()?>admin" class="" id="menu_dashboard">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:void(0);" id="menu_orders" class="main_a">
                          <i class="fa fa-dashboard"></i>
                          <span>Masters</span>
                      </a>
                        <ul class="sub">
                         <!--  <li><a href="<?=base_url()?>admin/Styling"> Styling Details</a></li>
                          <li><a href="<?=base_url()?>admin/styling_Slider">Styling Slider</a></li> -->
          
          				<li >
                              <a href="<?=base_url()?>admin/featured_jobs" class="" id="menu_featured_jobs">
                                  <i class="fa fa-book"></i>
                                  <span>Featured Jobs</span>
                              </a>
                          </li>
                          <li >
                              <a href="<?=base_url()?>admin/companies" class="" id="menu_companies">
                                  <i class="fa fa-book"></i>
                                  <span>Companies</span>
                              </a>
                          </li>
                          <li >
                              <a href="<?=base_url()?>admin/company_types" class="" id="menu_company_types">
                                  <i class="fa fa-book"></i>
                                  <span>Company Types</span>
                              </a>
                          </li>
                          <li >
                              <a href="<?=base_url()?>admin/job_roles" class="" id="menu_job_roles">
                                  <i class="fa fa-book"></i>
                                  <span>Job Roles</span>
                              </a>
                          </li>
                          <li >
                              <a href="<?=base_url()?>admin/work_modes" class="" id="menu_work_modes">
                                  <i class="fa fa-book"></i>
                                  <span>Work Modes</span>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <li >
                      <a href="<?=base_url()?>admin/home_banner" class="" id="menu_home_banner">
                          <i class="fa fa-image"></i>
                          <span>Home banner</span>
                      </a>
                  </li>
                  <li >
                      <a href="<?=base_url()?>admin/testimonials" class="" id="menu_testimonials">
                          <i class="fa fa-user"></i>
                          <span>Testimonials</span>
                      </a>
                  </li>
                  <li >
                      <a href="<?=base_url()?>admin/candidates" class="" id="menu_candidates">
                          <i class="fa fa-user"></i>
                          <span>Candidates</span>
                      </a>
                  </li>
                  <li >
                      <a href="<?=base_url()?>admin/recruiters" class="" id="menu_recruiters">
                          <i class="fa fa-briefcase"></i>
                          <span>Recruiters</span>
                      </a>
                  </li>
                  <li >
                      <a href="<?=base_url()?>admin/job_posts" class="" id="menu_job_posts">
                          <i class="fa fa-briefcase"></i>
                          <span>Job Posts</span>
                      </a>
                  </li>
                  
                  
                  
                      
              </ul>
          </div>
          <script>
            $('.sidebar-menu li a').removeClass('active');
            $('#menu_<?=strtolower($this->uri->segment(2, 0))?>').addClass('active');
             $('#menu_<?=strtolower($this->uri->segment(2, 0))?>').parents('.sub-menu').children('.main_a').addClass('active');
          </script>
