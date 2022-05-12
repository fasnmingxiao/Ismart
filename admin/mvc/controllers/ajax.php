<?php
class ajax extends controller
{
    public $user;
    public $product;
    public $deal;
    public $cus;
    public $slider;
    public $menu;
    public $post;
    public $page;
    function __construct()
    {
        $this->user = $this->model("user");
        $this->product = $this->model("productM");
        $this->deal = $this->model("dealM");
        $this->cus = $this->model("customerM");
        $this->slider = $this->model("sliderM");
        $this->menu = $this->model("menuM");
        $this->post = $this->model("blogM");
        $this->page = $this->model("pageM");
    }
    function checkUsername()
    {
        $username = $_POST['username'];
        $a = $this->user->checkUsername($username);
        if ($a == "true") {
            echo "Tài khoản đã tồn tại";
        } else {
            echo "Tài khoản có thể sử dụng";
        };
    }
    function updateaccount()
    {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        if ($this->user->update_account_admin($username, $fullname, $email, $tel)) {
            echo "Update successful!";
        } else {
            echo "Update fail";
        }
    }
    function changepass()
    {
        $pass_old = $_POST['po'];
        $pass_new = $_POST['pn'];
        $confirm_pass = $_POST['cp'];
        $un = $_SESSION['username'];
        $p = json_decode($this->user->get_password($un), true);

        if ($pass_old == "" || $pass_new == "" || $confirm_pass == "") {
            echo "Vui lòng nhập đầy đủ thông tin";
        } else {
            if ($pass_old == $p['password']) {
                if ($pass_new == $confirm_pass) {
                    if ($this->user->change_pass($un, $pass_old, $pass_new)) {
                        echo "Cập nhật mật khẩu thành công";
                    }
                } else {
                    echo "Mật khẩu mới không trùng khớp";
                }
            } else {
                echo "Mật khẩu cũ không chính xác";
            }
        }
    }
    function load_data()
    {
        $limit = 5;
        $page = 1;
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $search_key = '';
        if ($_POST['query'] != '') {
            $search_key = str_replace(' ', '%', $_POST['query']);
        }
        $total_data = count(json_decode($this->product->get_list_cat($search_key)), true);
        $result = json_decode($this->product->get_list_cat($search_key, $start, $limit), true);
        $output = '
            <label>Total Records- ' . $total_data . '</label>
            <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $edit = site_url("/product/edit_cat/" . $item['cat_id'] . "");
                $del = site_url("/product/del_cat/" . $item['cat_id'] . "");
                $output .= '
                    <tr>
                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                    <td><span class="tbody-text">' . $num . '</h3></span>
                    <td class="clearfix">
                    <div class="tb-title fl-left">
                    <a href="#" title="#">' . $item["Name"] . '</a>
                </div> 
                <ul class="list-operation fl-right">
                <li><a  href="' . $edit . '" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                <li><a href="' . $del . '" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                
                        </ul>
                    </td>
                    <td><span class="tbody-text">' . $item["ParentCatID"] . '</span></td>
                    <td><span class="tbody-text">' . $item["creator"] . '</span></td>
                    <td><span class="tbody-text">' . $item["date"] . '</span></td>
                </tr>
                    ';
                $num++;
            }
        } else {
            $output .= '
            <tr><td colspan="6" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
        </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                    <td><span class="tfoot-text">Thứ tự</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                </tr>
                            </tfoot>
                            </table>
                            </div>
                        </div>
                    </div>
                    <div class="section" id="paging-wp">
                    <ul class="pagging">
        ';
        $total_links = ceil($total_data / $limit);
        $previous_link = '';
        $next_link = '';
        $page_link = '';
        if ($total_links > 6) {
            if ($page < 5) {
                for ($count = 1; $count <= 5; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            } else {
                $end_limit = $total_links - 5;
                if ($page > $end_limit) {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $end_limit; $count <= $total_links; $count++) {
                        $page_array[] = $count;
                    }
                } else {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $page - 1; $count <= $page + 1; $count++) {
                        $page_array[] = $count;
                    }
                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }
        } else {
            for ($count = 1; $count <= $total_links; $count++) {
                $page_array[] = $count;
            }
        }
        if (isset($page_array)) {
            for ($count = 0; $count < count($page_array); $count++) {
                if ($page == $page_array[$count]) {
                    $page_link .= '
                    <li class="active"><a href="#">' . $page_array[$count] . '</a> </li>
                    ';
                    $previous_id = $page_array[$count] - 1;
                    if ($previous_id > 0) {
                        $previous_link = '<li><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Trước</a></li>';
                    } else {
                        $previous_link = ' <li class="disabled"><a class="page-link"  >Trước</a></li> ';
                    }
                    $next_id = $page_array[$count] + 1;
                    if ($next_id > $total_links) {
                        $next_link = ' <li class="disabled"><a class="page-link" >Sau</a></li> ';
                    } else {
                        $next_link = '<li><a  class="page-link" href="#" data-page_number="' . $next_id . '">Sau</a></li>';
                    }
                } else {
                    if ($page_array[$count] == '...') {
                        $page_link .= '<li class="disabled"><a class="page-link" href="#">...</a></li>';
                    } else {
                        $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                        data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>';
                    }
                }
            }
        }
        $output .= $previous_link . $page_link . $next_link;
        echo $output;
    }
    function get_sub_cat()
    {
        $id = $_POST['id'];
        $sub_cat = json_decode($this->product->get_cat_dropdown($id), true);
        $output = "<option value=''>-- Select Sub Category --</option>";
        foreach ($sub_cat as $item) {
            $output .= "<option value='" . $item['cat_id'] . "'>" . $item['Name'] . "</option>";
        }
        echo $output;
    }
    function load_data_product()
    {
        $limit = 5;
        $page = 1;
        if (!empty($_POST['status'])) {
            $status = $_POST['status'];
        } else {
            $status = '';
        }
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $search_key = '';
        if ($_POST['query'] != '') {
            $search_key = str_replace(' ', '%', $_POST['query']);
        }
        $list_all = json_decode($this->product->get_list_product_by_status(), true);
        $total_data = count(json_decode($this->product->get_list_product_by_status($status, $search_key)), true);
        $result = json_decode($this->product->get_list_product_by_status($status, $search_key, $start, $limit), true);
        $num_vrf = 0;
        $num_wait = 0;
        foreach ($list_all as $item) {
            if ($item['status'] == 2) {
                $num_vrf++;
            } else {
                $num_wait++;
            }
        }

        $output = '
                    <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã sản phẩm</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Tên sản phẩm</span></td>
                                    <td><span class="thead-text">Giá</span></td>
                                    <td><span class="thead-text">Danh mục</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $num++;
                $edit = site_url("/product/edit_product/" . $item['id'] . "");
                $del = site_url("/product/del_product/" . $item['id'] . "");
                $output .= '
                <tbody>
                <tr>
                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                    <td><span class="tbody-text">' . $num . '</h3></span>
                    <td><span class="tbody-text">' . $item['code'] . '</h3></span>
                                            <td>
                                                <div class="tbody-thumb ">
                                                    <img class="center-block " src="' . site_url("/public/images/" . $item['product_thumb']) . '" alt="">
                                                </div>
                                            </td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="" title="">' . $item['product_title'] . '</a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="' . $edit . '" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="' . $del . '" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"></span>' . current_format($item['price'], '') . '</span></td>
                                            <td><span class="tbody-text"></span>' . $item['Name'] . '</span></td>
                                            <td><span class="tbody-text">' . value_status($item['status']) . '</span></td>
                                            <td><span class="tbody-text">' . $item['creator'] . '</span></td>
                                            <td><span class="tbody-text">' . $item['create_at'] . '</span></td>
                                        </tr>
                ';
            }
        } else {
            $output .= '
            <tr><td colspan="6" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
        </tbody>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="tfoot-text">STT</span></td>
                                    <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                    <td><span class="tfoot-text">Hình ảnh</span></td>
                                    <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                    <td><span class="tfoot-text">Giá</span></td>
                                    <td><span class="tfoot-text">Danh mục</span></td>
                                    <td><span class="tfoot-text">Trạng thái</span></td>
                                    <td><span class="tfoot-text">Người tạo</span></td>
                                    <td><span class="tfoot-text">Thời gian</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                </div>
            <div class="section" id="paging-wp">
                    <ul class="pagging">
        ';
        $output .= $this->paging($total_data, $limit, $page);
        $data['output'] = $output;
        $data['vrf'] = "(" . $num_vrf . ")";
        $data['wait'] = "(" . $num_wait . ")";
        $data['all'] = "(" . count($list_all) . ")";
        echo json_encode($data);
    }
    function load_deal()
    {
        $limit = 5;
        $page = 1;
        if (!empty($_POST['status'])) {
            $status = $_POST['status'];
        } else {
            $status = '';
        }
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $search_key = '';
        if ($_POST['query'] != '') {
            $search_key = str_replace(' ', '%', $_POST['query']);
        }
        $list_all = json_decode($this->deal->get_deal(), true);
        $total_data = count(json_decode($this->deal->get_deal_ajax($status, $search_key)), true);
        $result = json_decode($this->deal->get_deal_ajax($status, $search_key, $start, $limit), true);
        $num_done = 0;

        foreach ($list_all as $item) {
            if ($item['status'] == 3) {
                $num_done++;
            }
        }
        $num_vrf = 0;
        foreach ($list_all as $item) {
            if ($item['status'] == 2) {
                $num_vrf++;
            }
        }
        $num_wait = 0;
        foreach ($list_all as $item) {
            if ($item['status'] == 1) {
                $num_wait++;
            }
        }
        $output = '
                    <table class="table list-table-wp">
                    <thead>
                    <tr>
                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                        <td><span class="thead-text">STT</span></td>
                        <td><span class="thead-text">Mã đơn hàng</span></td>
                        <td><span class="thead-text">Họ và tên</span></td>
                        <td><span class="thead-text">Trạng thái</span></td>
                        <td><span class="thead-text">Thời gian</span></td>
                        <td><span class="thead-text">Chi tiết</span></td>
                    </tr>
                </thead>
                <tbody>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $stt = 1;
                $output .= '
                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">' . $stt . '</h3></span>
                                    <td><span class="tbody-text">' . $item['code'] . '</h3></span>
                                    <td>
                                        <div class="tb-title fl-left">
                                            <a href="" title="">' . $item['full_name'] . '</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">' . $item['name'] . '</span></td>
                                    <td><span class="tbody-text">' . $item['date'] . '</span></td>
                                    <td><a href="' . site_url('/deal/detail_order/' . $item['id'] . '') . '" title="" class="tbody-text">Chi tiết</a></td>
                                </tr>
                ';
            }
        } else {
            $output .= '
            <tr><td colspan="6" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                        <td><span class="tfoot-text">Họ và tên</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                        <td><span class="tfoot-text">Chi tiết</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        </div>
                        </div>
                        <div class="section" id="paging-wp">
                                            <ul class="pagging">
        ';
        $output .= $this->paging($total_data, $limit, $page);
        $data['output'] = $output;
        $data['vrf'] = "(" . $num_vrf . ")";
        $data['wait'] = "(" . $num_wait . ")";
        $data['done'] = "(" . $num_done . ")";
        $data['all'] = "(" . count($list_all) . ")";

        echo json_encode($data);
    }
    function paging($total_data, $limit, $page)
    {
        $total_links = ceil($total_data / $limit);
        $previous_link = '';
        $next_link = '';
        $page_link = '';
        if ($total_links > 6) {
            if ($page < 5) {
                for ($count = 1; $count <= 5; $count++) {
                    $page_array[] = $count;
                }
                $page_array[] = '...';
                $page_array[] = $total_links;
            } else {
                $end_limit = $total_links - 5;
                if ($page > $end_limit) {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $end_limit; $count <= $total_links; $count++) {
                        $page_array[] = $count;
                    }
                } else {
                    $page_array[] = 1;
                    $page_array[] = '...';
                    for ($count = $page - 1; $count <= $page + 1; $count++) {
                        $page_array[] = $count;
                    }
                    $page_array[] = '...';
                    $page_array[] = $total_links;
                }
            }
        } else {
            for ($count = 1; $count <= $total_links; $count++) {
                $page_array[] = $count;
            }
        }
        if (isset($page_array)) {
            for ($count = 0; $count < count($page_array); $count++) {
                if ($page == $page_array[$count]) {
                    $page_link .= '
                    <li class="active"><a href="#">' . $page_array[$count] . '</a> </li>
                    ';
                    $previous_id = $page_array[$count] - 1;
                    if ($previous_id > 0) {
                        $previous_link = '<li><a class="page-link" href="javascript:void(0)" data-page_number="' . $previous_id . '">Trước</a></li>';
                    } else {
                        $previous_link = ' <li class="disabled"><a class="page-link"  >Trước</a></li> ';
                    }
                    $next_id = $page_array[$count] + 1;
                    if ($next_id > $total_links) {
                        $next_link = ' <li class="disabled"><a class="page-link" >Sau</a></li> ';
                    } else {
                        $next_link = '<li><a  class="page-link" href="#" data-page_number="' . $next_id . '">Sau</a></li>';
                    }
                } else {
                    if ($page_array[$count] == '...') {
                        $page_link .= '<li class="disabled"><a class="page-link" href="#">...</a></li>';
                    } else {
                        $page_link .= '<li class="page-item"><a class="page-link" href="javascript:void(0)" 
                        data-page_number="' . $page_array[$count] . '">' . $page_array[$count] . '</a></li>';
                    }
                }
            }
        }
        return $previous_link . $page_link . $next_link;
    }
    function update_status()
    {
        $stt = $_POST['id'];
        $id = $_POST['id_od'];
        $a = json_decode($this->deal->update_status($stt, $id), true);
        if ($a == true) {
            echo "Update thành công";
        } else {
            echo "Update thất bại";
        }
    }
    function load_customer()
    {
        $limit = 5;
        $page = 1;
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $search_key = '';
        if ($_POST['query'] != '') {
            $search_key = str_replace(' ', '%', $_POST['query']);
        }

        $list_all = json_decode($this->cus->get_list_all_customer(), true);
        $total_data = count(json_decode($this->cus->get_list_customer_by_qr($search_key), true));
        $result = json_decode($this->cus->get_list_customer_by_qr($search_key, $start, $limit), true);
        $output = '
                        <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Họ và tên</span></td>
                                <td><span class="thead-text">Số điện thoại</span></td>
                                <td><span class="thead-text">Email</span></td>
                                <td><span class="thead-text">Địa chỉ</span></td>
                                <td><span class="thead-text">Đơn hàng</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $stt = 1;
                $output .= '
                                <tr>
                                <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                <td><span class="tbody-text">' . $stt . '</h3></span>
                                <td>
                                    <div class="tb-title fl-left">
                                        <a href="" title="">' . $item['full_name'] . '</a>
                                    </div>
                                    <ul class="list-operation fl-right">
                                        <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                                <td><span class="tbody-text">' . $item['phone'] . '</span></td>
                                <td><span class="tbody-text">' . $item['email'] . '</span></td>
                                <td><span class="tbody-text">' . $item['adress'] . '</span></td>
                                <td><span class="tbody-text">' . $item['qty_order'] . '</span></td>
                                <td><span class="tbody-text">' . $item['date'] . '</span></td>
                            </tr>
                ';
            }
        } else {
            $output .= '
            <tr><td colspan="8" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-body">STT</span></td>
                                        <td><span class="tfoot-body">Họ và tên</span></td>
                                        <td><span class="tfoot-body">Số điện thoại</span></td>
                                        <td><span class="tfoot-body">Email</span></td>
                                        <td><span class="tfoot-body">Địa chỉ</span></td>
                                        <td><span class="tfoot-body">Đơn hàng</span></td>
                                        <td><span class="tfoot-body">Thời gian</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        </div>
                        </div>
                        <div class="section" id="paging-wp">
                                            <ul class="pagging">
        ';
        $output .= $this->paging($total_data, $limit, $page);
        $data['output'] = $output;
        $data['all'] = "(" . count($list_all) . ")";

        echo json_encode($data);
    }

    function load_list_slider()
    {
        $limit = 5;
        $page = 1;
        $id_stt = 0;
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }

        if (isset($_POST['status'])) {
            if ($_POST['status'] > 0) {
                $id_stt = $_POST['status'];
            }
        }

        $list_all = json_decode($this->slider->get_list_slider(), true);

        $total_data = count(json_decode($this->slider->get_list_slider_by_stt($id_stt), true));
        $result = json_decode($this->slider->get_list_slider_by_stt($id_stt, $start, $limit), true);
        $num_wait = 0;
        $num_vrf = 0;

        foreach ($list_all as $item) {
            if ($item['status'] = 2) {
                $num_wait++;
            } else {
                $num_vrf++;
            }
        }
        $output = '         <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Hình ảnh</span></td>
                                    <td><span class="thead-text">Link</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                            </thead>
                            <tbody>
                        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $stt = 1;
                $output .= '
                <tr>
                                    <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                    <td><span class="tbody-text">' . $stt . '</h3></span>
                                    <td>
                                        <div class="tbody-thumb">
                                            <img src="' . $item['image'] . '" alt="">
                                        </div>
                                    </td>
                                    <td class="clearfix">
                                        <div class="tb-title fl-left">
                                            <a href="" title="">' . $item['link'] . '</a>
                                        </div>
                                        <ul class="list-operation fl-right">
                                            <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                            <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </td>
                                    <td><span class="tbody-text">' . $item['num_show'] . '</span></td>
                                    <td><span class="tbody-text">' . $item['name'] . '</span></td>
                                    <td><span class="tbody-text">' . $item['creator'] . '</span></td>
                                    <td><span class="tbody-text">' . $item['last_update'] . '</span></td>
                                </tr>
                    ';
            }
        } else {

            $output .= '<tr><td colspan="8" align="center" >No Data Found</td></tr>';
        };
        $output .= '
                        </tbody>
                        <tfoot>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="tfoot-text">STT</span></td>
                                <td><span class="tfoot-text">Hình ảnh</span></td>
                                <td><span class="tfoot-text">Link</span></td>
                                <td><span class="tfoot-text">Thứ tự</span></td>
                                <td><span class="tfoot-text">Trạng thái</span></td>
                                <td><span class="tfoot-text">Người tạo</span></td>
                                <td><span class="tfoot-text">Thời gian</span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                </div>
                </div>
                <div class="section" id="paging-wp">
                            <ul class="pagging">';
        $output .= $this->paging($total_data, $limit, $page);
        $data['output'] = $output;
        $data['all'] = "(" . count($list_all) . ")";
        $data['vrf'] = "(" . $num_vrf . ")";
        $data['wait'] = "(" . $num_wait . ")";
        echo json_encode($data);
    }
    function load_table_menu()
    {
        $limit = 5;
        $page = 1;
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $total_data = count(json_decode($this->menu->get_menu(), true));
        $result = json_decode($this->menu->get_menu($start, $limit), true);
        $output = '
                    <table class="table list-table-wp">
                    <thead>
                        <tr>
                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                            <td><span class="thead-text">STT</span></td>
                            <td><span class="thead-text">Tên menu</span></td>
                            <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                            <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                            <td style="text-align: center;"><span class="thead-text">Parent_id</span></td>
                        </tr>
                    </thead>
                    <tbody>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $num++;

                $output .= '
                            <tr>
                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value="2"></td>
                            <td><span class="tbody-text">' . $num . '</span>
                            <td>
                                <div class="tb-title fl-left">
                                    <a href="" title="">' . $item['menu_title'] . '</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="#" onclick="load_edit_menu()" data-id="' . $item['menu_id'] . '" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="#" onclick="del_menu()" title="Xóa"  data-id="' . $item['menu_id'] . '" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <td style="text-align: center;"><span class="tbody-text">' . $item['menu_url'] . '</span></td>
                            <td style="text-align: center;"><span class="tbody-text">' . $item['num_show'] . '</span></td>
                            <td style="text-align: center;"><span class="tbody-text">' . $item['menu_parent_id'] . '</span></td>
                        </tr>
                ';
            }
        } else {
            $output .= '
            <tr><td colspan="6" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Tên menu</span></td>
                                        <td style="text-align: center;"><span class="thead-text">Slug</span></td>
                                        <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                        <td style="text-align: center;"><span class="thead-text">Parent ID</span></td>
                                        

                                    </tr>
                                </tfoot>
                            </table>
                            </div>
                        <div class="section" id="paging-wp">
                                            <ul class="pagging">
        ';
        $output .= $this->paging($total_data, $limit, $page);
        echo $output;
    }
    function get_sub_menu()
    {
        $id = $_POST['id'];
        $sub_menu = json_decode($this->menu->get_sub_menu($id), true);
        $output = "<option value='0'>-- Chọn --</option>";
        foreach ($sub_menu as $item) {
            $output .= "<option value='" . $item['menu_id'] . "'>" . $item['menu_title'] . "</option>";
        }
        echo $output;
    }
    function insert_menu()
    {
        $title = $_POST['title'];
        $url = $_POST['url'];
        $parent_id = $_POST['parent_id'];
        $num_show = $_POST['num_show'];
        $result = $this->menu->insert_menu($title, $url, $parent_id, $num_show);
        if ($result == true) {
            echo "Import thành công";
        } else {
            echo "Import lỗi";
        }
    }
    function load_menu_edit()
    {
        $id = $_POST['id'];
        $result = json_decode($this->menu->get_menu_by_id($id), true);
        $parent = json_decode($this->menu->get_parent_url_dropdown(), true);
        $output = '
        <form method="POST" action="" id="form_menu" onsubmit="update_menu()">
                        <div class="form-group">
                            <label for="title">Tên menu</label>
                            <input type="text" name="title" id="title" value="' . $result['menu_title'] . '" required>
                        </div>
                        <p class="mess_error"></p>
                        <div class="form-group">
                            <label for="url-static">Đường dẫn tĩnh</label>
                            <input type="text" name="url_static" id="url-static" value="' . $result['menu_url'] . '" required>
                            <p>Chuỗi đường dẫn tĩnh cho menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Parent id</label>
                            <select name="page_slug" id="dropdown_menu">
                                <option value="0">-- Chọn --</option>';
        foreach ($parent as $item) {
            if ($item['menu_id'] = $result['menu_parent_id']) {
                $output .= '<option value="' . $item['menu_id'] . '" selected>' . $item['menu_title'] . '</option>';
            } else {
                $output .= '<option value="' . $item['menu_id'] . '">' . $item['menu_title'] . '</option>';
            }
        };
        $output .= '</select>
                            <p>Trang liên kết đến menu</p>
                        </div>
                        <div class="form-group clearfix">
                            <label>Sub parent id</label>
                            <select name="page_slug" id="dropdown_sub_menu">


                            </select>
                            <p>Danh mục liên kết đến Trang</p>
                        </div>

                        <div class="form-group">
                            <label for="menu-order">Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order" value="' . $item['num_show'] . '" required>
                        </div>
                        <p class="mess_error"></p>
                        <div class="form-group">
                            <button type="button" name="sm_update" data-id="'.$result['menu_id'].'" onclick="update_menu()" id="btn-update-menu">Cập nhật</button>
                            <div class="msg"></div>
                        </div>
                    </form>
        ';
        echo $output;
    }
    function del_menu()
    {
        $id = $_POST['id'];
        $result = $this->menu->del_menu_by_id($id);
        echo $result;
    }
    function load_list_blog()
    {
        $limit = 5;
        $page = 1;
        if (!empty($_POST['status'])) {
            $status = $_POST['status'];
        } else {
            $status = '';
        }
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $search_key = '';
        if ($_POST['query'] != '') {
            $search_key = str_replace(' ', '%', $_POST['query']);
        }
        $list_all = json_decode($this->post->get_all_post(), true);
        $total_data = count(json_decode($this->post->get_post_ajax($status, $search_key)), true);
        $result = json_decode($this->post->get_post_ajax($status, $search_key, $start, $limit), true);
        $num_vrf = 0;
        foreach ($list_all as $item) {
            if ($item['status'] == 2) {
                $num_vrf++;
            }
        }
        $num_wait = 0;
        foreach ($list_all as $item) {
            if ($item['status'] == 1) {
                $num_wait++;
            }
        }
        $output = '
                        <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tiêu đề</span></td>
                                <td><span class="thead-text">Ảnh bài viết</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Người tạo</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $num++;
                $output .= '
                            <tr>
                            <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                            <td><span class="tbody-text">' . $num . '</h3></span>
                            <td class="clearfix">
                                <div class="tb-title fl-left">
                                    <a href="" title="">' . $item['title'] . '</a>
                                </div>
                                <ul class="list-operation fl-right">
                                    <li><a href="" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                    <li><a href="" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                </ul>
                            </td>
                            <id><img src="' . $item['img_thumb'] . '" alt=""></id>
                            <td><span class="tbody-text">' . $item['status'] . '</span></td>
                            <td><span class="tbody-text">' . $item['creator'] . '</span></td>
                            <td><span class="tbody-text">' . $item['last_update'] . '</span></td>
                        </tr>
                ';
            }
        } else {
            $output .= '
            <tr><td colspan="7" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="tfoot-text">STT</span></td>
                                        <td><span class="tfoot-text">Tiêu đề</span></td>
                                        <td><span class="tfoot-text">Ảnh bài viết</span></td>
                                        <td><span class="tfoot-text">Trạng thái</span></td>
                                        <td><span class="tfoot-text">Người tạo</span></td>
                                        <td><span class="tfoot-text">Thời gian</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        </div>
                        </div>
                        <div class="section" id="paging-wp">
                                            <ul class="pagging">
        ';
        $output .= $this->paging($total_data, $limit, $page);
        $data['output'] = $output;
        $data['vrf'] = "(" . $num_vrf . ")";
        $data['wait'] = "(" . $num_wait . ")";
        $data['all'] = "(" . count($list_all) . ")";
        echo json_encode($data);
    }
    function insert_post()
    {
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $file = $_POST['file'];
        $date = date("F j, Y, g:i a");
        $creator = $_POST['creator'];
        $result = $this->post->insert($title, $file, $date, $desc, $creator);
        if ($result == true) {
            echo "Success! ^^";
        } else {
            echo "failer @@";
        }
    }
    function insert_product()
    {
        $name = $_POST['name'];
        // dd($name);
        $code = $_POST['code'];
        // dd($code);
        $price = $_POST['price'];
        // dd($price);
        $discount = $_POST['discount'];
        // dd($discount);
        $desc = $_POST['desc'];
        // dd($desc);
        $content = $_POST['content'];
        // dd($content);
        $img = $_POST['img'];
        // dd($img);
        $list_img = $_POST['list_img'];
        // dd($list_img);
        $cat = $_POST['cat'];
        // dd($cat);
        $stt = $_POST['stt'];
        // dd($stt);
        $qty = $_POST['qty'];
        // dd($qty);
        $date = date('Y-m-d H:i:s');
        $a = $this->product->add_product($name, $code, $desc, $content, $img, $list_img, $stt, $date, $_SESSION['user_login'], $price, $discount, $qty, $cat);
        echo $a;
    }
    function update_product()
    {
        $name = $_POST['name'];
        // dd($name);
        $code = $_POST['code'];
        // dd($code);
        $price = $_POST['price'];
        // dd($price);
        $discount = $_POST['discount'];
        // dd($discount);
        $desc = $_POST['desc'];
        // dd($desc);
        $content = $_POST['content'];
        // dd($content);
        $img = $_POST['img'];
        // dd($img);
        $list_img = $_POST['list_img'];
        // dd($list_img);
        $cat = $_POST['cat'];
        // dd($cat);
        $stt = $_POST['stt'];
        // dd($stt);
        $qty = $_POST['qty'];
        // dd($qty);
        $id = $_POST['id'];
        $date = date('Y-m-d H:i:s');
        $mess = $this->product->update_product($name, $code, $desc, $content, $img, $stt, $date, $_SESSION['user_login'], $price, $qty, $cat, $discount, $list_img, $id);
        echo $mess;
    }
    function add_page()
    {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $date = date('Y-m-d H:i:s');
        echo $this->page->add_page($title, $slug, $date);
    }
    function load_menu_page()
    {
        $limit = 5;
        $page = 1;
        if ($_POST['page'] > 1) {
            $start = ($_POST['page'] - 1) * $limit;
            $page = $_POST['page'];
        } else {
            $start = 0;
        }
        $total_data = count(json_decode($this->page->get_page(), true));
        $result = json_decode($this->page->get_page($start, $limit), true);
        $output = '
                        <table class="table list-table-wp">
                        <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Tiêu đề</span></td>
                                <td><span class="thead-text">Slug</span></td>
                                <td><span class="thead-text">Thời gian</span></td>
                            </tr>
                        </thead>
                        <tbody>
        ';
        if ($total_data > 0) {
            $num = $start;
            foreach ($result as $item) {
                $num++;
                $output .= '
                            <tr>
                                <td><input type="checkbox" name="checkItem" class="checkItem"></td>
                                <td><span class="tbody-text">'.$num.'</h3></span>
                                <td class="clearfix">
                                    <div class="tb-title fl-left">
                                        <a href="" title="">'.$item['page_title'].'</a>
                                    </div>
                                    <ul class="list-operation fl-right">
                                        <li><a href="#" onclick="load_edit_page()" data-id="'.$item['id'].'" title="Sửa"  class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                        <li><a href="#" title="Xóa" onclick="del_page()" data-id="'.$item['id'].'" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                    </ul>
                                </td>
                                <td><span class="tbody-text">'.$item['page_link'].'</span></td>
                                <td><span class="tbody-text">'.$item['create_at'].'</span></td>
                            </tr>   
                ';
            }
        } else {
            $output .= '
            <tr><td colspan="5" align="center" >No Data Found</td></tr>
            ';
        };
        $output .= '
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="tfoot-text">STT</span></td>
                                                <td><span class="tfoot-text">Tiêu đề</span></td>
                                                <td><span class="tfoot-text">Slug</span></td>
                                                <td><span class="tfoot-text">Thời gian</span></td>
                                                
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                        <div class="section" id="paging-wp">
                                            <ul class="pagging">
        ';
        $output .= $this->paging($total_data, $limit, $page);
        echo $output;
    }
    function load_page_edit(){
        $id = $_POST['id'];
        $result = json_decode($this->page->get_page_by_id($id), true);
        $output = '
                <form method="POST" id="my-form" >
                    <label for="title">Tiêu đề</label>
                    <input style="width:100%" type="text" name="title" id="title" value="'.$result['page_title'].'" required>
                    <label for="title">Slug ( Friendly_url )</label>
                    <input style="width:100%" type="text" name="slug" id="slug" value="'.$result['page_link'].'" required>
                    <button type="button" data-id="'.$result['id'].'" onclick="update_page()" data-id="2" style="margin-bottom:10px;" name="btn-submit" id="btn-submit">Cập nhật</button>
                </form>
        ';
        echo $output;
    }
    function update_page(){
        $id= $_POST['id'];
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $date = date('Y-m-d H:i:s');
        echo $this->page->update_page($title, $slug, $date,$id);
    }
    function update_menu(){
        $id=$_POST['id'];
        $title = $_POST['title'];
        $url = $_POST['url'];
        $parent_id = $_POST['parent_id'];
        $num_show = $_POST['num_show'];
        echo  $this->menu->update_menu($title, $url, $parent_id, $num_show,$id);
    }
    function del_page()
    {
        $id = $_POST['id'];
        $result = $this->page->del_page_by_id($id);
        echo $result;
    }
}
