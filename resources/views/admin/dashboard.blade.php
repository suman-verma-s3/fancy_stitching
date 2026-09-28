@extends('layouts.admin')


@section('title', 'Dashboard | FancyStitch')


@section('page-title', 'Admin Dashboard')


@section(
    'page-subtitle',
    'Manage your fancy and stitching business'
)


@push('styles')

<style>

    .welcome {
        margin-bottom: 25px;
    }


    .welcome h1 {
        font-size: 30px;

        margin-bottom: 7px;
    }


    .welcome p {
        color: #777;
    }


    .stats {
        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 18px;
    }


    .stat-card {
        background: #fff;

        padding: 23px;

        border-radius: 17px;

        border: 1px solid #eee;

        box-shadow:
            0 7px 25px
            rgba(0, 0, 0, 0.04);
    }


    .stat-label {
        color: #777;

        font-size: 13px;
    }


    .stat-value {
        margin-top: 9px;

        font-size: 30px;

        font-weight: 700;
    }


    .stat-note {
        margin-top: 7px;

        color: #aaa;

        font-size: 12px;
    }


    .section-grid {
        display: grid;

        grid-template-columns: 2fr 1fr;

        gap: 20px;

        margin-top: 20px;
    }


    .panel {
        background: #fff;

        border: 1px solid #eee;

        border-radius: 17px;

        padding: 22px;

        box-shadow:
            0 7px 25px
            rgba(0, 0, 0, 0.04);
    }


    .panel-header {
        display: flex;

        align-items: center;

        justify-content: space-between;

        margin-bottom: 20px;
    }


    .panel-header h3 {
        font-size: 18px;
    }


    .panel-header span {
        color: #999;

        font-size: 12px;
    }


    .chart {
        height: 270px;

        background: #fcf6f8;

        border-radius: 13px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #a47784;
    }


    .stock-row {
        display: flex;

        justify-content: space-between;

        padding: 14px 0;

        border-bottom:
            1px solid #eee;
    }


    .stock-row:last-child {
        border-bottom: 0;
    }


    .stock-count {
        color: #b86c81;

        font-weight: 600;
    }


    .quick-actions {
        margin-top: 20px;
    }


    .actions {
        display: grid;

        grid-template-columns:
            repeat(4, 1fr);

        gap: 15px;
    }


    .action {
        background: #fff;

        padding: 20px;

        border: 1px solid #eee;

        border-radius: 14px;

        transition: 0.2s;
    }


    .action:hover {
        transform:
            translateY(-3px);

        box-shadow:
            0 8px 20px
            rgba(0, 0, 0, 0.06);
    }


    .action h4 {
        margin-bottom: 7px;
    }


    .action p {
        color: #777;

        font-size: 12px;
    }


    @media (max-width: 1100px) {

        .stats {
            grid-template-columns:
                repeat(2, 1fr);
        }


        .actions {
            grid-template-columns:
                repeat(2, 1fr);
        }


        .section-grid {
            grid-template-columns: 1fr;
        }

    }


    @media (max-width: 768px) {

        .stats,
        .actions {
            grid-template-columns: 1fr;
        }


        .welcome h1 {
            font-size: 24px;
        }


        .panel {
            padding: 18px;
        }


        .chart {
            height: 220px;
        }

    }

</style>

@endpush



@section('content')


<div class="welcome">


    <h1>

        Welcome back,
        {{ $user->name }}!

    </h1>


    <p>

        Here is your store overview.

    </p>


</div>



<div class="stats">


    <div class="stat-card">

        <div class="stat-label">

            Total Products

        </div>


        <div class="stat-value">

            0

        </div>


        <div class="stat-note">

            Fancy and stitching

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-label">

            Total Orders

        </div>


        <div class="stat-value">

            0

        </div>


        <div class="stat-note">

            All orders

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-label">

            Customers

        </div>


        <div class="stat-value">

            0

        </div>


        <div class="stat-note">

            Registered customers

        </div>

    </div>



    <div class="stat-card">

        <div class="stat-label">

            Total Profit

        </div>


        <div class="stat-value">

            ₹0

        </div>


        <div class="stat-note">

            Overall profit

        </div>

    </div>


</div>



<div class="section-grid">


    <div class="panel">


        <div class="panel-header">

            <h3>
                Sales Overview
            </h3>


            <span>
                Last 30 Days
            </span>

        </div>


        <div class="chart">

            Sales chart will appear here

        </div>


    </div>



    <div class="panel">


        <div class="panel-header">

            <h3>
                Low Stock
            </h3>

        </div>


        <div class="stock-row">

            <span>
                No products yet
            </span>


            <span class="stock-count">
                0
            </span>

        </div>


        <div class="stock-row">

            <span>
                Low stock items
            </span>


            <span class="stock-count">
                0
            </span>

        </div>


    </div>


</div>



<div class="panel quick-actions">


    <div class="panel-header">

        <h3>
            Quick Actions
        </h3>

    </div>



    <div class="actions">


        <a
            href="#"
            class="action"
        >

            <h4>
                Add Product
            </h4>


            <p>
                Add a new fancy product.
            </p>

        </a>



        <a
            href="#"
            class="action"
        >

            <h4>
                Add Stitching
            </h4>


            <p>
                Add a new stitching service.
            </p>

        </a>



        <a
            href="#"
            class="action"
        >

            <h4>
                View Orders
            </h4>


            <p>
                Manage customer orders.
            </p>

        </a>



        <a
            href="#"
            class="action"
        >

            <h4>
                Messages
            </h4>


            <p>
                Check customer messages.
            </p>

        </a>


    </div>


</div>


@endsection