<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?php echo base_url('user'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <?php
        $role_id = $this->session->userdata('role_id');
        $qeuryMenu = "SELECT `user_menu`.`id`,`menu`,`icon` 
                            FROM `user_menu` JOIN `user_access_menu` 
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC";
        $menu = $this->db->query($qeuryMenu)->result_array();
        ?>
        <?php foreach ($menu as $m) : ?>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class=" <?= $m['icon']; ?> "></i>
                    <p>
                        <?= $m['menu']; ?>
                    </p>
                </a>
                <?php
                $menuId = $m['id'];
                $qeurySubMenu = "SELECT * 
                                    FROM `user_sub_menu` JOIN `user_menu` 
                                     ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                    WHERE `user_sub_menu`.`menu_id`= $menuId 
                                    AND `user_sub_menu`.`is_active`=1";
                $SubMenu = $this->db->query($qeurySubMenu)->result_array();
                ?>

                <?php foreach ($SubMenu as $sm) : ?>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a href="<?= base_url($sm['url']); ?>" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $sm['title']; ?></p>
                            </a>
                        </li>
                    </ul>

                <?php endforeach; ?>
            <?php endforeach; ?>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url('auth/logout') ?>" class="nav-link">
                    <i class="nav-icon fas fa-window-close"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>