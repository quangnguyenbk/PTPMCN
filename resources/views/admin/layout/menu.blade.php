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
                            <a href="#"><i class="fa fa-cube fa-fw"></i>Đơn hàng nhập<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/purchaseorders/list">Danh sách yêu cầu nhập hàng</a>
                                </li>
                                <?php $user = Auth::user();
                                if( $user->hasRole('kho') ){ ?>
                                <li>
                                    <a href="admin/purchaseorders/add">Thêm yêu cầu đơn hàng mới</a>
                                </li>
                                <?php } ?>
                                <li>
                                    <a href="admin/purchaseorders/listpass">Đơn hàng nhận</a>
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
                                    <a href="admin/sales_order/shiper">Phân công shipper </a>
                                </li>
                                <?php $user = Auth::user();
                                if( $user->hasRole('kho') ){ ?>
                                <li>
                                    <a href="admin/sales_order/sale">Xuất hàng </a>
                                </li>
                                <?php } ?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="admin/laptop/list"><i class="fa fa-cube fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin/laptop/list">Danh sách</a>
                                </li>
                                <li>
                                    <a href="admin/laptop/add">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>