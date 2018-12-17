<?php
use App\User;
?>
<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="admin/supplier/list"><i class="fa fa-bar-chart-o fa-fw"></i> Nhà cung cấp<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/supplier/list">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/supplier/add">Thêm </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cube fa-fw"></i>Nhập hàng<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/purchaseorders/list">Danh sách đơn hàng</a>
                                </li>
                                <?php $user = Auth::user();
                                if( $user->hasRole('kho') ){ ?>
                                <li>
                                    <a href="admin/purchaseorders/add">Thêm đơn hàng</a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="admin/purchaseorders/add">Đơn hàng đã nhận</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="admin/sales_order/list"><i class="fa fa-bar-chart-o fa-fw"></i> Đơn hàng xuất<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/sales_order/list">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/sales_order/add">Thêm </a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="admin/laptop/list"><i class="fa fa-cube fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/laptop/list">List Product</a>
                                </li>
                                <li>
                                    <a href="admin/laptop/add">Add Product</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">List User</a>
                                </li>
                                <li>
                                    <a href="#">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>