<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
?>

<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside dark dk" layout="column">
        <div class="navbar navbar-md no-radius">
            <!-- brand -->
            <a class="navbar-brand" href="{{ route('adminHome') }}">
                <img src="{{ URL::to('backEnd/assets/images/logo.png') }}" style="width: 195px; max-height: 35px;" alt="Control">
                <!-- <span class="hidden-folded inline">{{ trans('backLang.control') }}</span> -->
            </a>
            <!-- / brand -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ trans('backLang.main') }}</small>
                    </li>

                    <li>
                        <a href="{{ route('adminHome') }}" onclick="location.href='{{ route('adminHome') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe3fc;</i>
                          </span>
                            <span class="nav-text">{{ trans('backLang.dashboard') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shopPackages') }}" onclick="location.href='{{ route('shopPackages') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Shop Packages</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('shopPackages') }}" onclick="location.href='{{ route('shopPackages') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Featured Shops</span>
                        </a>
                    </li>


                    <li>
                                <a>
                      <span class="nav-caret">
                        <i class="fa fa-caret-down"></i>
                      </span>
                                        <span class="nav-icon">
                        <i class="material-icons">&#xe1b8;</i>
                      </span>
                            <span class="nav-text">Categories</span>
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <a onclick="location.href='{{ route('categories') }}'">
                                    <span class="nav-text">Parent Categories</span>
                                </a>
                            </li>
                            <li>
                                <a onclick="location.href='{{ route('SubCategories') }}'">
                                    <span class="nav-text">Sub Categories</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--  start Disconuts  --}}
                    <li>
                        <a>
              <span class="nav-caret">
                <i class="fa fa-caret-down"></i>
              </span>
                                <span class="nav-icon">
                <i class="material-icons">&#xe1b8;</i>
              </span>
                    <span class="nav-text">Discounts</span>
                </a>
                <ul class="nav-sub">
                    <li>
                        <a onclick="location.href='{{ route('coupons') }}'">
                            <span class="nav-text">Coupons</span>
                        </a>
                    </li>
                       {{--  <li>
                        <a onclick="location.href='{{ route('deals') }}'">
                            <span class="nav-text">Deals</span>
                        </a>
                    </li>  --}}
                </ul>
            </li>
                    {{--  End Discounts  --}}
                    <li>
                        <a>
              <span class="nav-caret">
                <i class="fa fa-caret-down"></i>
              </span>
                                <span class="nav-icon">
                <i class="material-icons">&#xe1b8;</i>
              </span>
                    <span class="nav-text">Wallets</span>
                </a>
                <ul class="nav-sub">
                    <li>
                        <a onclick="location.href='{{ route('wallets') }}'">
                            <span class="nav-text">Manage Wallets</span>
                        </a>
                    </li>
                       {{--  <li>
                        <a onclick="location.href='{{ route('deals') }}'">
                            <span class="nav-text">Deals</span>
                        </a>
                    </li>  --}}
                </ul>
            </li>
                    {{-- start wallet --}}

                    {{-- end wallet --}}

                    <!-- Product Types -->
                    <li>
                                <a>
                      <span class="nav-caret">
                        <i class="fa fa-caret-down"></i>
                      </span>
                                        <span class="nav-icon">
                        <i class="material-icons">&#xe1b8;</i>
                      </span>
                            <span class="nav-text">Products Types</span>
                        </a>
                        <ul class="nav-sub">
                            <li>
                                <a onclick="location.href='{{ route('productType') }}'">
                                    <span class="nav-text">List</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="/admin/product/create" onclick="location.href='/admin/product/create'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe3fc;</i>
                          </span>
                            <span class="nav-text">Add Product</span>
                        </a>
                    </li>
                    <!-- /Product Types -->

                    <!-- Approval -->
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Approval</small>
                    </li>

                    <li>
                        <a onclick="location.href='{{ route('getApprovalListAffialiators') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Affiliator Approvals</span>
                        </a>
                    </li>

                    <!-- Shop -->
                    <li>
                        <a onclick="location.href='{{ route('shopApprovalList') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Shop Approvals</span>
                        </a>
                    </li>

                    <!-- Product-->
                    <li>
                        <a onclick="location.href='{{ route('prodcutApprovalList') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Products Approvals</span>
                        </a>
                    </li>

                    <li>
                        <a onclick="location.href='{{ route('EditprodcutApprovalList') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Edit Products Approvals</span>
                        </a>
                    </li>
                    <li>
                        <a onclick="location.href='{{ route('approveDeliveredProducts') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Approve Delivered Products</span>
                        </a>
                    </li>
                    <li>
                        <a onclick="location.href='/admin/shopperApproval'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Approve Shop Partners</span>
                        </a>
                    </li>
                    <li>
                        <a onclick="location.href='/admin/withdrawRequests'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">Approve Withdraws</span>
                        </a>
                    </li>
                    <!--Approval End-->


                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Messages</small>
                    </li>

                    <li>
                        <a onclick="location.href='{{ route('contactUsMessages') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">All Messages</span>
                        </a>
                    </li>

                    <!--Details-->
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">Details</small>
                    </li>

                    <li>
                        <a onclick="location.href='{{ route('productsAll') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">All Products</span>
                        </a>
                    </li>

                    <li>
                        <a onclick="location.href='{{ route('shopsAll') }}'">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">All Shops</span>
                        </a>
                    </li>

                     <li>
                        <a href="/admin/orders">
                          <span class="nav-icon">
                            <i class="material-icons">&#xe1b8;</i>
                          </span>
                            <span class="nav-text">All Orders</span>
                        </a>
                    </li>

                    <!--Details-->

                    @if(Helper::GeneralWebmasterSettings("settings_status"))
                        @if(@Auth::user()->permissionsGroup->settings_status)
                            <li class="nav-header hidden-folded">
                                <small class="text-muted">{{ trans('backLang.settings') }}</small>
                            </li>

                            <?php
                            $currentFolder = "settings"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "menus"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "users"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder2));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2 || $PathCurrentFolder3==$currentFolder3 ) ? 'class=active' : '' }}>
                                <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                    <span class="nav-icon">
<i class="material-icons">&#xe8b8;</i>
</span>
                                    <span class="nav-text">{{ trans('backLang.generalSiteSettings') }}</span>
                                </a>
                                <ul class="nav-sub">

                                    <?php
                                    $currentFolder = "users"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('users') }}">
                                            <span class="nav-text">{{ trans('backLang.usersPermissions') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif

                </ul>
            </nav>
        </div>
        <div flex-no-shrink>
            <div>
                <nav ui-nav>
                    <ul class="nav">

                        <li>
                            <div class="b-b b m-t-sm"></div>
                        </li>
                        <li class="no-bg"><a href="{{ url('/logout') }}"
                                             onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <span class="nav-icon"><i class="material-icons">&#xe8ac;</i></span>
                                <span class="nav-text">{{ trans('backLang.logout') }}</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
