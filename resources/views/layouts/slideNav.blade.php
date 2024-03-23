        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html"> --}}
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('Cus.index') }}?type={{ 'index' }}" >
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">ระบบกฎหมาย<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">



            <!-- <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li> -->


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>ระบบลูกค้า</span>
                </a>
                <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item @yield('DataCus')" href="{{ route('Cus.index') }}?type={{'Datacus'}}"><i class="fa-solid fa-phone-volume"></i> ฐานข้อมูลลูกหนี้</a>
                        {{-- <a class="collapse-item @yield('DataCon')" href="{{ route('Con.index') }}?type={{'Datacon'}}"><i class="fa-solid fa-phone-volume"></i> ฐานข้อมูลสัญญา</a> --}}
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>ระบบกฎหมาย</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        {{-- <a class="collapse-item @yield('DataCus') "   href="{{ route('Cus.index') }}?type={{'Datacus'}}"><i class="fa-solid fa-phone-volume"></i> ลูกหนี้ ชั้นเตรียมฟ้อง</a> --}}
                        <a class="collapse-item @yield('DataCourt')" href="{{ route('Law.index') }}?type={{'DataCourt'}}"><i class="fa-solid fa-phone-volume"></i> ลูกหนี้ ชั้นศาล</a>
                        <a class="collapse-item @yield('execution')" href="{{ route('Exe.index') }}?type={{'DataExecution'}}"><i class="fa-solid fa-phone-volume"></i> ลูกหนี้ ชั้นบังคับคดี</a>
                        <a class="collapse-item @yield('Data')" href="{{ route('LawCom.index') }}?type={{'DataCom'}}"><i class="fa-solid fa-phone-volume"></i> ลูกหนี้ ประนอมหนี้</a>
                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseThree">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>ระบบติดตาม</span>
                </a>
                <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        {{-- <a class="collapse-item @yield('DataCus') "   href="{{ route('Cus.index') }}?type={{'Datacus'}}"><i class="fa-solid fa-phone-volume"></i> ลูกหนี้ ชั้นเตรียมฟ้อง</a> --}}
                        <a class="collapse-item @yield('LawTrak')" href="{{ route('LawTrack.index') }}"><i class="fa-solid fa-phone-volume"></i> ปฏิทินทนาย</a>
                        <a class="collapse-item @yield('LawFinFuture')" href="{{ route('Fin.index') }}?type={{ 'LawFinFuture' }}" ><i class="fa-solid fa-phone-volume"></i> เบิกเงินล่วงหน้า</a>
                        <a class="collapse-item @yield('NotAppFin')" href="{{ route('Fin.index') }}?type={{ 'NotAppFin' }}" ><i class="fa-solid fa-phone-volume"></i> รายการเบิกที่รออนุมัติ</a>
                       
                    </div>
                </div>
            </li>

            {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tabCommissions"
                    aria-expanded="true" aria-controls="tabCommissions">
                    <i class="fa-brands fa-bitcoin"></i>
                    <span>ระบบลูกหนี้ประนอมหนี้</span>
                </a>
                <div id="tabCommissions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>
                        <a class="collapse-item @yield('ReportDept')" href="{{ route('Dept.index') }}?type={{'ReportDept'}}"><i class="fa-solid fa-chart-column"></i> รายงานตามหนี้ </a>
                        <a class="collapse-item @yield('OldCompro')" href="{{ route('LawCom.index') }}?type={{'OldCompro'}}"><i class="fa-solid fa-chart-column"></i> ลูกหนี้ประนอมเก่า</a>
                        <a class="collapse-item" href=""><i class="fa-solid fa-chart-column"></i> รายการติดตามลูกหนี้</a>
                        <a class="collapse-item" href=""><i class="fa-solid fa-chart-column"></i> รายการรับชำระค่างวด</a>
                        <a class="collapse-item" href=""><i class="fa-solid fa-chart-column"></i> แจ้งเตือนขาดชำระลูกหนี้</a> 
                    </div>
                </div>
            </li> --}}


            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Addons
            </div> -->

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
