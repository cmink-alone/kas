
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="" class="user_foto img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <p class="nama_user"></p>

                                    <a href="#"> <strong class='nik_user'></strong></a>
                                </div>
                            </div>
                      
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <ul class="sidebar-menu">
                                <li id='dashboard' class="active lis">
                                    <a class='dashboard' href="#">
                                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <li id='aturan' class="lis">
                                    <a class="aturan " href="#">
                                        <i class=" fa fa-gavel"></i><span>Aturan</span>
                                    </a>
                                </li>

                                <li id='pemasukan' class="lis">
                                    <a class="pemasukan" href="#" href="#">
                                        <i class="fa fa-sort-amount-desc fa-rotate-180"></i> <span>Pemasukan</span>
                                    </a>
                                </li>
                                
                                <li  id='pengeluran' class="lis">
                                    <a href="#" class="pengeluran">
                                        <i class="fa fa-sort-amount-desc"></i> <span>Pengeluran</span>
                                    </a>
                                </li>


                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

    <script type="text/javascript">

        $('.aturan').click(function(){
            $('.lis').removeClass('active');
             $('#aturan').addClass('active');
          $('.in_konten').load(base_url + 'user/aturan');
        });


        $('.pengeluran').click(function(){
            $('.lis').removeClass('active');
             $('#pengeluran').addClass('active');
          $('.in_konten').load(base_url + 'user/pengeluaran');
        });

        $('.pemasukan').click(function(){
            $('.lis').removeClass('active');
             $('#pemasukan').addClass('active');
          $('.in_konten').load(base_url + 'user/pemasukan');
        });

        $('.dashboard').click(function(){
             $('.lis').removeClass('active');
            $('#dashboard').addClass('active');
            $('.in_konten').load(base_url+'user/dashboard');
        });

    </script>