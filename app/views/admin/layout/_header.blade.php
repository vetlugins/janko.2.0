<a href="/" class="logo"><i class="fa fa-bolt"></i> <span>janko<span>.cms</span> 2.0</span></a>
<nav class="navbar navbar-static-top">
    <a href="#" class="navbar-btn sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-header">
        <form role="search" class="navbar-form" method="post" action="#" style="display:none;">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type="submit" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
                            </span>
            </div>
        </form>
    </div>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown dropdown-notifications" style="display: none">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell"></i><span class="label label-warning">5</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header"><i class="fa fa-bell"></i>  You have 5 new notifications</li>
                    <li>
                        <ul>
                            <li><a href="#"><i class="fa fa-users success"></i> New user registered</a></li>
                            <li><a href="#"><i class="fa fa-heart info"></i> Jane liked your post</a></li>
                            <li><a href="#"><i class="fa fa-envelope warning"></i> You got a message from Jean</a></li>
                            <li><a href="#"><i class="fa fa-info success"></i> Privacy settings have been changed</a></li>
                            <li><a href="#"><i class="fa fa-comments danger"></i> New comments waiting approval</a></li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">View all notification</a></li>
                </ul>
            </li>

            <li class="dropdown dropdown-messages" style="display: none">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope"></i><span class="label label-success">6</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header"><i class="fa fa-envelope"></i> You have 6 messages</li>
                    <li>
                        <ul>
                            <li>
                                <a href="#">
                                    <div class="pull-left"><img src="img/avatar.jpg" class="img-rounded" alt="image"/></div>
                                    <h4>Jill Doe<small><i class="fa fa-clock-o"></i> 1 mins</small></h4>
                                    <p>Can we meet somewhere?</p>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <div class="pull-left"><img src="img/avatar.jpg" class="img-rounded" alt="image"/></div>
                                    <h4>John Doe<small><i class="fa fa-clock-o"></i> 2 mins</small></h4>
                                    <p>Please send me a new email.</p>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <div class="pull-left"><img src="img/avatar.jpg" class="img-rounded" alt="image"/></div>
                                    <h4>Jeremy Doe<small><i class="fa fa-clock-o"></i> 30 mins</small></h4>
                                    <p>Don't forget to subscribe to...</p>
                                </a>
                            </li>

                            <li>
                                <a href="#">
                                    <div class="pull-left"><img src="img/avatar.jpg" class="img-rounded" alt="image"/></div>
                                    <h4>Jean Doe<small><i class="fa fa-clock-o"></i> 2 hours</small></h4>
                                    <p>I sent you a mail about me.</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer"><a href="#">View all messages</a></li>
                </ul>
            </li>

            <li class="dropdown dropdown-tasks" style="display: none">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-tasks"></i><span class="label label-danger">1</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header"><i class="fa fa-tasks"></i>  You have 1 new task</li>
                    <li>
                        <ul>
                            <li>
                                <a href="#">
                                    <h3>PHP Developing<small class="pull-right">32%</small></h3>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success" style="width: 32%" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <h3>Database Repair<small class="pull-right">14%</small></h3>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning" style="width: 14%" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <h3>Backup Create<small class="pull-right">65%</small></h3>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-info" style="width: 65%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <h3>Create New Modules<small class="pull-right">80%</small></h3>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-danger" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="footer">
                        <a href="#">View all tasks</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="/" class="btn btn-xs btn-default" style="padding: 10px; margin-top: 3px" target="_blank">
                    На сайт
                </a>
            </li>

            <li class="dropdown widget-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="img/avatar.jpg" class="pull-left" alt="image" style="display: none" />
                    <div class="visible-xs text-center"><i class="fa fa-user" style="font-size: 24px"></i></div>
                    <span>{{ Auth::user()->displayName() }} <i class="fa fa-caret-down"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ URL::route ( 'admin.users.edit', Auth::user()->id ) }}"><i class="fa fa-user"></i>Профиль</a>
                    </li>
                    <li class="footer">
                        <a href="/admin/logout"><i class="fa fa-power-off"></i>Выход</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>