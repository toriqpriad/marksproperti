<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->        
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">                    
                <?php
                if ($active_page == 'dashboard') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>                
                <a href="<?= site_url() ?>admin" >
                    <i class="mdi mdi-view-dashboard mdi-24px"></i>
                    <span>Dashboard</span>
                </a>
                </li>
                <?php
                if ($active_page == 'kat_properti') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>                
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-flag-variant mdi-24px"></i>
                    <span>Kategori Properti</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/kategori_properti" class="waves-effect waves-block">                                
                            <span>Data Kategori Properti</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/kategori_properti/add" class="waves-effect waves-block">                                
                            <span>Tambah Kategori Properti</span>
                        </a>                            
                    </li>                    


                </ul>
                </li>
                <?php
                if ($active_page == 'properti') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>   
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-home mdi-24px"></i>
                    <span>Properti</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/properti/" class="waves-effect waves-block">                                
                            <span>Data Properti</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/properti/add" class="waves-effect waves-block">                                
                            <span>Tambah Properti</span>
                        </a>                            
                    </li>

                </ul>

                <?php
                if ($active_page == 'artikel') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>   
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-file-document mdi-24px"></i>
                    <span>Artikel</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/artikel" class="waves-effect waves-block">                                
                            <span>Data Artikel</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/artikel/add" class="waves-effect waves-block">                                
                            <span>Tambah Artikel</span>
                        </a>                            
                    </li>

                </ul>
                </li>
                <?php
                if ($active_page == 'iklan') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>  
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-tag-multiple mdi-24px"></i>
                    <span>Iklan</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/iklan" class="waves-effect waves-block">                                
                            <span>Data Iklan</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/iklan/add" class="waves-effect waves-block">                                
                            <span>Tambah Iklan</span>
                        </a>                            
                    </li>


                </ul>
                </li>
                <?php
                if ($active_page == 'portfolio') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>  
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-book-open-page-variant mdi-24px"></i>
                    <span>Portfolio</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/portfolio" class="waves-effect waves-block">                                
                            <span>Data Portfolio</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/portfolio/add" class="waves-effect waves-block">                                
                            <span>Tambah Portfolio</span>
                        </a>                            
                    </li>


                </ul>
                </li>
                <?php
                if ($active_page == 'developer') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>  
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-incognito mdi-24px"></i>
                    <span>Developer</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/developer" class="waves-effect waves-block">                                
                            <span>Data Developer</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/developer/add" class="waves-effect waves-block">                                
                            <span>Tambah Developer</span>
                        </a>                            
                    </li>
                </ul>
                </li>
                <?php
                if ($active_page == 'setting') {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                ?>                  
                <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                    <i class="mdi mdi-account-settings-variant mdi-24px"></i>
                    <span>Setting</span>
                </a>
                <ul class="ml-menu" style="display: none;">
                    <li>
                        <a href="<?= site_url() ?>admin/setting/website" class="waves-effect waves-block">                                
                            <span>Website</span>
                        </a>                            
                    </li>
                    <li>
                        <a href="<?= site_url() ?>admin/setting/account" class="waves-effect waves-block">                                
                            <span>Login</span>
                        </a>                            
                    </li>
                </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                <a href="javascript:void(0);">Marksproperti.com </a> &copy; 2017
            </div>

        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <!-- #END# Right Sidebar -->
</section>