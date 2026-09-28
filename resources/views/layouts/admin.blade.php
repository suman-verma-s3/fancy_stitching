<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'FancyStitch Admin')
    </title>


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f7f4f5;
            color: #292126;
        }


        a {
            text-decoration: none;
            color: inherit;
        }


        button {
            font-family: inherit;
        }


        /* =========================================
           SIDEBAR
        ========================================= */

        .sidebar {
            position: fixed;

            top: 0;
            left: 0;
            bottom: 0;

            width: 250px;

            background: #261b20;

            color: #fff;

            padding: 22px 15px;

            z-index: 1000;

            transition: transform 0.3s ease;

            overflow-y: auto;
        }


        .sidebar-header {
            display: flex;

            align-items: center;

            justify-content: space-between;

            padding-bottom: 28px;
        }


        .logo {
            font-size: 25px;

            font-weight: 700;

            padding-left: 15px;
        }


        .logo span {
            color: #e4a4b5;
        }


        .sidebar-close {
            display: none;

            width: 36px;
            height: 36px;

            border: none;

            border-radius: 8px;

            background: #38272e;

            color: #fff;

            font-size: 24px;

            cursor: pointer;

            align-items: center;

            justify-content: center;

            line-height: 1;
        }


        .sidebar-close:hover {
            background: #b86c81;
        }


        /* =========================================
           MENU
        ========================================= */

        .menu-title {
            color: #9d9095;

            font-size: 11px;

            text-transform: uppercase;

            letter-spacing: 1px;

            margin: 10px 15px 12px;
        }


        .menu a {
            display: block;

            color: #ddd;

            padding: 12px 15px;

            border-radius: 10px;

            margin-bottom: 5px;

            font-size: 14px;

            transition: 0.2s;
        }


        .menu a:hover,
        .menu a.active {
            background: #b86c81;

            color: #fff;
        }


        /* =========================================
           LOGOUT
        ========================================= */

        .logout-area {
            margin-top: 25px;

            padding-bottom: 5px;
        }


        .logout-button {
            width: 100%;

            border: 0;

            padding: 12px;

            border-radius: 10px;

            background: #38272e;

            color: #fff;

            cursor: pointer;

            font-size: 14px;

            transition: 0.2s;
        }


        .logout-button:hover {
            background: #b86c81;
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {
            margin-left: 250px;

            min-height: 100vh;

            transition: margin-left 0.3s ease;
        }


        /* =========================================
           TOPBAR
        ========================================= */

        .topbar {
            min-height: 78px;

            background: #fff;

            border-bottom: 1px solid #eee;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 14px 30px;

            position: sticky;

            top: 0;

            z-index: 900;
        }


        .left-header {
            display: flex;

            align-items: center;

            gap: 15px;
        }


        .menu-toggle {
            display: none;

            width: 42px;
            height: 42px;

            border: 1px solid #eee;

            background: #fff;

            border-radius: 10px;

            cursor: pointer;

            font-size: 20px;

            align-items: center;

            justify-content: center;
        }


        .menu-toggle:hover {
            background: #f7eef1;
        }


        .topbar h2 {
            font-size: 21px;
        }


        .topbar p {
            margin-top: 4px;

            color: #888;

            font-size: 13px;
        }


        /* =========================================
           PROFILE
        ========================================= */

        .profile {
            display: flex;

            align-items: center;

            gap: 12px;
        }


        .profile-info {
            text-align: right;
        }


        .profile-name {
            font-size: 14px;

            font-weight: 600;
        }


        .profile-role {
            margin-top: 3px;

            color: #888;

            font-size: 12px;
        }


        .avatar {
            width: 42px;
            height: 42px;

            border-radius: 50%;

            background: #e4a4b5;

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

            font-weight: 700;
        }


        /* =========================================
           OVERLAY
        ========================================= */

        .overlay {
            display: none;

            position: fixed;

            inset: 0;

            background: rgba(0, 0, 0, 0.45);

            z-index: 999;
        }


        /* =========================================
           CONTENT
        ========================================= */

        .content {
            padding: 30px;
        }


        /* =========================================
           PAGE HEADER
        ========================================= */

        .page-header {
            margin-bottom: 25px;
        }


        .page-header h1 {
            font-size: 28px;

            margin-bottom: 7px;
        }


        .page-header p {
            color: #777;

            margin-bottom: 12px;
        }


        .breadcrumb {
            display: flex;

            align-items: center;

            gap: 7px;

            color: #999;

            font-size: 12px;
        }


        .breadcrumb .home {
            color: #b86c81;

            font-weight: 600;
        }


        .breadcrumb .separator {
            color: #bbb;
        }


        .breadcrumb .current {
            color: #777;
        }


        /* =========================================
           RESPONSIVE
        ========================================= */

        @media (max-width: 1100px) {

            .content {
                padding: 25px;
            }

        }


        @media (max-width: 768px) {

            .sidebar {
                transform: translateX(-100%);
            }


            .sidebar.active {
                transform: translateX(0);
            }


            .sidebar-close {
                display: flex;
            }


            .main {
                margin-left: 0;
            }


            .menu-toggle {
                display: flex;
            }


            .overlay.active {
                display: block;
            }


            .topbar {
                padding: 12px 15px;
            }


            .profile-info {
                display: none;
            }


            .content {
                padding: 20px 15px;
            }


            .page-header h1 {
                font-size: 24px;
            }

        }


        @media (max-width: 480px) {

            .topbar h2 {
                font-size: 18px;
            }


            .topbar p {
                font-size: 11px;
            }


            .avatar {
                width: 38px;
                height: 38px;
            }


            .page-header h1 {
                font-size: 22px;
            }

        }

    </style>


    @stack('styles')

</head>


<body>


<!-- =========================================
     MOBILE OVERLAY
========================================= -->

<div
    class="overlay"
    id="overlay"
></div>



<!-- =========================================
     SIDEBAR
========================================= -->

<aside
    class="sidebar"
    id="sidebar"
>


    <div class="sidebar-header">


        <div class="logo">

            Fancy<span>Stitch</span>

        </div>


        <button
            type="button"
            class="sidebar-close"
            id="sidebarClose"
        >

            &times;

        </button>


    </div>



    <div class="menu-title">

        Main Menu

    </div>



    <nav class="menu">


        <!-- Dashboard -->

        <a
            href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard

        </a>
        <!-- Categories -->
        <a
            href="{{ route('admin.categories') }}"
            class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
            Categories
        </a>



        <!-- Products -->

        <a
            href="{{ route('admin.products')}}"
                      class="{{ request()->routeIs('admin.products') ? 'active' : '' }}">
            Fancy Products

        </a>



        <!-- Stitching -->

        <a href="{{route('admin.stitching-services.index')}}" class="{{
        request()->routeIs('admin.stitching-services.index') ?'active' : '' }}">

            Stitching Services

        </a>



        <!-- Orders -->

        <a href="#">

            Orders

        </a>



        <!-- Customers -->

        <a href="#">

            Customers

        </a>



        <!-- Reviews -->

        <a href="#">

            Reviews

        </a>



        <!-- Messages -->

        <a href="#">

            Messages

        </a>



        <!-- Reports -->

        <a href="#">

            Reports

        </a>



        <!-- Settings -->

        <a href="#">

            Settings

        </a>


    </nav>



    <!-- =====================================
         LOGOUT
    ====================================== -->

    <div class="logout-area">


        <form
            action="{{ route('logout') }}"
            method="POST"
        >

            @csrf


            <button
                type="submit"
                class="logout-button"
            >

                Logout

            </button>


        </form>


    </div>


</aside>



<!-- =========================================
     MAIN
========================================= -->

<main class="main">


    <!-- =====================================
         TOPBAR
    ====================================== -->

    <header class="topbar">


        <div class="left-header">


            <!-- Mobile Menu Button -->

            <button
                type="button"
                class="menu-toggle"
                id="menuToggle"
            >

                ☰

            </button>


            <div>


                <h2>

                    @yield(
                        'page-title',
                        'Admin Dashboard'
                    )

                </h2>


                <p>

                    @yield(
                        'page-subtitle',
                        'Manage your fancy and stitching business'
                    )

                </p>


            </div>


        </div>



        <!-- =================================
             ADMIN PROFILE
        ================================== -->

        <div class="profile">


            <div class="profile-info">


                <div class="profile-name">

                    {{ auth()->user()->name }}

                </div>


                <div class="profile-role">

                    Administrator

                </div>


            </div>


            <div class="avatar">

                {{ strtoupper(
                    substr(
                        auth()->user()->name,
                        0,
                        1
                    )
                ) }}

            </div>


        </div>


    </header>



    <!-- =====================================
         PAGE CONTENT
    ====================================== -->

    <section class="content">


        @yield('content')


    </section>


</main>



<!-- =========================================
     JAVASCRIPT
========================================= -->

<script>


    const menuToggle =
        document.getElementById('menuToggle');


    const sidebar =
        document.getElementById('sidebar');


    const sidebarClose =
        document.getElementById('sidebarClose');


    const overlay =
        document.getElementById('overlay');



    /* ========================================
       OPEN SIDEBAR
    ======================================== */

    function openSidebar() {

        sidebar.classList.add('active');

        overlay.classList.add('active');

        document.body.style.overflow = 'hidden';

    }



    /* ========================================
       CLOSE SIDEBAR
    ======================================== */

    function closeSidebar() {

        sidebar.classList.remove('active');

        overlay.classList.remove('active');

        document.body.style.overflow = '';

    }



    /* ========================================
       MENU TOGGLE
    ======================================== */

    menuToggle.addEventListener(
        'click',
        openSidebar
    );



    /* ========================================
       CLOSE BUTTON
    ======================================== */

    sidebarClose.addEventListener(
        'click',
        closeSidebar
    );



    /* ========================================
       OVERLAY CLICK
    ======================================== */

    overlay.addEventListener(
        'click',
        closeSidebar
    );



    /* ========================================
       WINDOW RESIZE
    ======================================== */

    window.addEventListener(
        'resize',
        function () {

            if (window.innerWidth > 768) {

                closeSidebar();

            }

        }
    );


</script>


@stack('scripts')


</body>

</html>