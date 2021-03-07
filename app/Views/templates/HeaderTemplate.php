<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Online Menu Ordering Application</title>
    <meta name="description" content="Exam for POSBang Corporation">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?=base_url('assets/css/styles.css')?>">
</head>

<style>
body {
    font-family: monospace;
    background: #f8f9fa;
}

header .navbar {
    box-shadow: 0 1px 5px #d3d3d3;
}

header .navbar-brand {
    color: #df7171!important;
}

header .cart_btn a {
    color: #333;
    position: relative;
    text-decoration: none;
}

header .cart_btn a::before {
    content: '';
    position: absolute;
    left: -40%;
    top: 0;
    height: 100%;
    border: solid 1px #e3e3e3;
}

header .cart_btn a i {
    cursor: pointer;
    padding: 5px;
    color: #df7171;
}

footer nav {
    text-align: center;
    padding: 10px;
}

.banner_page img {
    height: 35vh;
    width: 100%;
    object-fit: cover;
    margin: 55px auto 0;
    display: block;
}

.category_list {
    padding: 10px 5% 0;
    border-bottom: none;
    position: relative;
    box-shadow: 0 1px 5px #d3d3d3;
    background: #fff;
}

.category_list li {
    padding: 0 5px;
}

.category_list li button {
    color: #888;
    padding-bottom: 10px;
    border: none!important;
}

.category_list li button.active,
.category_list li button:hover {
    color: #000;
    font-weight: 900;
    border-bottom: solid 3px!important;
    border-color: #df7171!important;
}

.food_list {
    margin-top: 30px;
    background: #fff;
    padding: 20px 5%;
    display: inline-block;
}

.food_list ul {
    list-style: none;
    width: 100%;
    padding: 0;
    margin: 0;
}

.food_list ul li {
    width: 50%;
    float: left;
    box-sizing: border-box;
    margin-top: 10px;
    margin-bottom: 10px;
}

.food_list ul li:nth-child(odd) {
    padding-right: 10px;
}

.food_list ul li:nth-child(even) {
    padding-left: 10px;
}

.food_list ul li .item_container {
    box-shadow: 0 1px 5px #d3d3d3;
    display: inline-flex;
    width: 100%;
    padding: 10px;
    cursor: pointer;
}

.food_list .item_container:active{
    animation: bounce ease-in-out .1s;
}

.food_list ul li .item_container img {
    width: 25%;
    height: 14vh;
    object-fit: cover;
}

.food_list ul li .item_container .details {
    width: 75%;
    padding-left: 10px;
    position: relative;
}

.food_list ul li .item_container .details .title {
    font-weight: 700;
    color: #000;
    display: inline-block;
    width: 100%;
    font-size: 15px;
}

.food_list ul li .item_container .details .description {
    font-weight: 400;
    color: #888;
    display: inline-block;
    width: 100%;
    line-height: 1;
    min-height: 40px;
}

.food_list ul li .item_container .details .price {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding-left: 10px;
    font-size: 15px;
}

.food_list ul li .item_container .details .price i {
    float: right;
    font-size: 20px;
    color: #df7171;
    cursor: pointer;
    transition: all ease-in-out .3s;
}

.food_list ul li .item_container:hover i {
    font-size: 22px!important;
}

@keyframes bounce{
    0%{
        transform: scale(1);
    }
    50%{
        transform: scale(.95);
    }
    100%{
        transform: scale(1);
    }
}

.summary {
    margin: 100px auto;
    display: block;
    width: 80%;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    border-top: solid 5px #df7171;
}

.summary .page_title {
    text-align: center;
    font-weight: 700;
    font-size: 20px;
    position: relative;
}

.summary .page_subtitle{
    text-align: center;
    margin: 20px auto 0;
    color: #999;
}

.summary .page_title::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: 50%;
    transform: translate(-50%, 100%);
    border-bottom: solid 2px #df7171;
    width: 10%;
}

.summary .order_list {
    margin-top: 50px;
}

.summary .order_list table {
    width: 100%;
    margin-bottom: 30px;
}

.summary .order_list table td:nth-child(1) {
    width: 15%;
}

.summary .order_list table td:nth-child(2) {
    width: 65%;
    padding-left: 20px;
}

.summary .order_list table td:nth-child(3) {
    width: 20%;
}
.summary .order_list table .quantity_actions{
    display: inline-flex;
    width: 100%;
    text-align: center;
}

.summary .order_list table .quantity_actions .quantity {
    font-weight: 700;
    font-size: 16px;
    width: 100%;
}

.summary .order_list table .table_sub_tl {
    padding-right: 20px;
    font-weight: 500;
}

.summary .order_list table .table_main_tl {
    padding-right: 20px;
    font-weight: 700;
    font-size: 18px;
}

.summary .discount_area{
    display: none;
}
.summary .discount_area.active{
    display: table-row;
}

.checkout_container {
    margin: 100px auto;
    display: block;
    width: 80%;
    background: #fff;
    padding: 20px;
    border-radius: 5px;
    border-top: solid 5px #df7171;
}

.checkout_container .page_title {
    text-align: center;
    font-weight: 700;
    font-size: 20px;
    position: relative;
}

.checkout_container .page_title::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: 50%;
    transform: translate(-50%, 100%);
    border-bottom: solid 2px #df7171;
    width: 10%;
}

.checkout_container .order_list {
    margin-top: 50px;
}

.checkout_container .order_list table {
    width: 100%;
}

.checkout_container .order_list table td:nth-child(1) {
    width: 15%;
}

.checkout_container .order_list table td:nth-child(2) {
    width: 65%;
    padding-left: 20px;
}

.checkout_container .order_list table td:nth-child(3) {
    width: 20%;
}
.checkout_container .order_list table .quantity_actions{
    display: inline-flex;
    width: 100%;
    text-align: center;
}
.checkout_container .order_list table .quantity_actions .hidden {
    display: none;
}
.checkout_container .order_list table .quantity_actions i{
    margin: auto;
    color: #df7171;
    cursor: pointer;
    font-size: 12px;
    width: 100%;
}

.checkout_container .order_list table .quantity_actions .quantity {
    font-weight: 700;
    font-size: 16px;
    width: 100%;
}

.checkout_container .order_list table .table_sub_tl {
    padding-right: 20px;
    font-weight: 500;
}

.checkout_container .order_list table .table_main_tl {
    padding-right: 20px;
    font-weight: 700;
    font-size: 18px;
}

.checkout_container .order_list .voucher_area {
    width: 70%;
    margin: 50px auto 30px;
    display: block;
}

.checkout_container .order_list .voucher_area button {
    background: #df7171;
    color: #fff;
    border: solid 1px #df7171;
    box-shadow: none!important;
    cursor: pointer;
    transition: all ease .3s;
}

.checkout_container .order_list .voucher_area button:hover {
    background: #de6666;
}

.checkout_container .order_list .voucher_area input {
    box-shadow: none!important;
    outline: none;
}

.checkout_container .order_list .save_order {
    margin: 20px auto;
    display: block;
    background: #df7171;
    color: #fff;
    border: solid 1px #df7171;
    width: 70%;
    padding: 10px;
}

.checkout_container .invalid_coupon{
    display: none;
}
.checkout_container .discount_area{
    display: none;
}
.checkout_container .discount_area.active{
    display: table-row;
}
.checkout_container h1{
    text-align: center;
    margin: 50px auto;
}
</style>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=base_url()?>/">POSBang Corporation</a>
                <div class="d-flex cart_btn">
                    <a href="<?=base_url()?>/Checkout">
                        <i class="fa fa-shopping-cart"></i><span class="order_count"></span>
                    </a>
                </div>
            </div>
        </nav>
    </header>