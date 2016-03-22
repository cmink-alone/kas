<header class="header">
            <a href="#" class="logo">
                KAS OUTASK
            </a>
		
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="<?php echo base_url()."asset/user/";?>#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="pm"><a href="#" title="Pembayaran Anda"><i class="fa fa-tags"></i> </a></li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label ps_label label-success"></span>
                            </a>

                        <!-- menu -->
                            <ul class="dropdown-menu">
                                <li class="header  text-center ps_judul"></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu ps_isi">
                                    

                                    </ul>
                                </li>
                                <li class="footer pesan_detail"><a href="#">Detail Pesan</a></li>
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span class="nama_user"> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>

                                    <li>
                                        <a class='profile' href="#">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                            Profile
                                        </a>
                                        <a class="settings" href="#">
                                        <i class="fa fa-cog fa-fw pull-right"></i>
                                            Settings
                                        </a>
                                        </li>

                                        <li class="divider"></li>

                                        <li>
                                            <a href="<?php echo base_url().'login/logout';?>"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
        </header>
        <script type="text/javascript">
            $('.settings').click(function(){
                $('.in_konten').load(base_url + 'user/g_pass');
            })

            $('.profile').click(function(){
                $('.in_konten').load(base_url + 'user/profile');
            })
    var ps = JSON.parse('<?=$pesan?>');
    var base_url ="<?php echo base_url();?>";
    if(ps.length>0){
        $('.ps_judul').html('Anda mempunyai '+ps.length+' pesan baru');
        $('.ps_label').html(ps.length);

    }else{
        ps=JSON.parse('<?=$ps_y;?>');
        $('.ps_judul').html('Anda tidak mempunyai pesan baru');
    }

    for(i=0;i<ps.length;i++){
            ps_isi='<li>'+
                        '<a>'+
                            '<div class="pull-left">'+
                                '<img src="'+base_url+'asset/img/'+ps[i].foto+'" class="img-rounded" alt="'+ps[i].dari+'"/>'+
                            '</div>'+
                            '<h4>'+ps[i].judul+'</h4>'+
                            '<p class="wr">Anda telah Membayar iuaran bulan '+bulan(ps[i].pesan)+' '+ps[i].id1+'.  </p>'+
                            '<small class="pull-right"><i class="fa fa-clock-o"></i> '+ps[i].waktu+'</small>'+
                        '</a>'+
                    '</li>';
            $('.ps_isi').append(ps_isi);
            ps_isi='';
        }

    $('.pesan_detail').click(function(){
        $('.in_konten').load(base_url+'user/pesan_detail');
    });
    $('.pm').click(function(){
        $('.in_konten').load(base_url+'user/pesan_arsip');
    });
</script>    
