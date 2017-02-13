<!-- TOP NAVBAR -->
    <nav role="navigation" class="navbar navbar-fixed-bottom sb-slide">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="entypo-menu"></span>
                </button>
                <button class="navbar-toggle toggle-menu-mobile toggle-left" type="button">
                    <span class="entypo-list-add"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse dropup">
              <div id="nt-title-container" class="navbar-left running-text visible-lg">
                  <ul class="date-top">
                      <li class="entypo-calendar" style="margin-right:5px"></li>
                      <li id="Date"></li>


                  </ul>

                  <ul id="digital-clock" class="digital middle-clock">
                      <li class="entypo-clock" style="margin-right:5px"></li>
                      <li class="hour"></li>
                      <li>:</li>
                      <li class="min"></li>
                      <li>:</li>
                      <li class="sec"></li>
                      <li class="meridiem"></li>
                  </ul>
                  <ul id="nt-title">
                      <li>
                        <ul id="digital-clock-pst" class="digital">
                            <li class="entypo-clock" style="margin-right:5px"></li>
                            <li class="hour"></li>
                            <li>:</li>
                            <li class="min"></li>
                            <li>:</li>
                            <li class="sec"></li>
                            <li class="meridiem"></li>
                        </ul>
                      </li>
                      <li>
                        <ul id="digital-clock-est" class="digital">
                            <li class="entypo-clock" style="margin-right:5px"></li>
                            <li class="hour"></li>
                            <li>:</li>
                            <li class="min"></li>
                            <li>:</li>
                            <li class="sec"></li>
                            <li class="meridiem"></li>
                        </ul>
                      </li>
                  </ul>
              </div>
                <ul style="margin-right:0;" class="nav navbar-nav navbar-right nav-avatar">
                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" class="admin-pic img-circle" src="<?php echo $img_url; ?>">Hi, <?php echo $username; ?> <b class="caret"></b>
                        </a>
                        <ul style="margin-top:14px;" role="menu" class="dropdown-setting dropdown-menu">
                            <li>
                                <a href="profile.html">
                                    <span class="entypo-user"></span>&#160;&#160;My Profile</a>
                            </li>
                            <li>
                                <a href="lock">
                                    <span class="icon-lock"></span>&#160;&#160;Lock</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout">
                                    <span class="entypo-logout"></span>&#160;&#160;Logout</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="maki-art-gallery"></span>&#160;&#160;Theme</a>
                        <ul role="menu" class="dropdown-setting dropdown-menu">

                            <li class="theme-bg">
                                <div id="button-bg"></div>
                                <div id="button-bg2"></div>
                                <div id="button-bg3"></div>
                                <div id="button-bg5"></div>
                                <div id="button-bg6"></div>
                                <div id="button-bg7"></div>
                                <div id="button-bg8"></div>
                                <div id="button-bg9"></div>
                                <div id="button-bg10"></div>
                                <div id="button-bg11"></div>
                                <div id="button-bg12"></div>
                                <div id="button-bg13"></div>
                            </li>
                        </ul>
                    </li>
                    <li class="hidden-xs">
                        <a class="toggle-left" href="#">
                            <span style="font-size:20px;" class="entypo-list-add"></span>
                        </a>
                    </li>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>