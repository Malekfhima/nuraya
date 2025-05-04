<?php
extract($_POST);
if($username != "nuraya11220365" || $password != "nuraya11220365" ){
    echo"<script>alert('makich ladmin')</script>";
    header("Refresh:0 url=index.html");
}else{
    header("location : ../uploads/index.html");  
}