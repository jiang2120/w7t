@extends('layouts.base')

@section('css')
<link rel='stylesheet' href='/css/about.css' />
<link rel='stylesheet' href='/css/effects.css' />
@endsection

@section('content')
    <h1 class='title'>
     使用说明
    </h1>

<div class='about-contents'>
    @if ($role == "admin")
    <dl>
        <p>网站信息</p>
        <dt>版本： {{env('POLR_VERSION')}}</dt>
        <dt>创建时间： {{env('POLR_RELDATE')}}</dt>
        <dt>安装时间： {{env('APP_NAME')}} on {{env('APP_ADDRESS')}} on {{env('POLR_GENERATED_AT')}}<dt>
    </dl>
    @endif
        <h3 class='title'>使用步骤</h3>
        <p> 1、放入淘宝链接；</p>
        <p> 2、点击"生成微信跳转链接"按钮；</p>
        <p> 3、5秒之内生成的一个微信跳转淘宝短链接，同时能创建一个二维码！</p>
        <p> 4、放入微信引导粉丝到淘宝购买；</p>
        <p> 5、如推广宝贝要修改，可进入"用户中心"的"链接管理"修改宝贝地址；</p>
    <p>注意：方便管理你的链接和统计点击数据，如未注册请先：<a href='/signup' target="_blank">注册</a> ，如已经注册请先： <a href="/login" target="_blank">登录</a>.
    </p>
</div>
    <h3 class='title'>功能介绍（全功能免费，每天转换次数无上限。）</h3>
    <p>1、{{env('APP_NAME')}}是一个淘宝链接的的转换工具，主要用于帮助商家解决微信无法打开天猫、淘宝店铺的烦恼。</p>
    <p>2、店铺推广活动，推新品，微信公众号向店铺引流，只需要把淘宝链接做个转换，解决微信向淘宝引流难题！</p>
    <p>3、系统会帮助您统计出转换后的链接点击数据以及地区来源。</p>
<a href='#' class='btn btn-success license-btn'>更多功能</a>
<pre class="license" id="gpl-license">
4、所有商品页面地址转换；
5、店铺首页地址转换；
6、商品地址页转换；
7、淘宝直播地址转换；
8、优惠券地址转换；
9、h5活动页面地址转换；
10、美店装修页面地址转换；
11、淘宝众筹页面地址转换；
12、买家秀页面地址转换；
13、数据统计功能；
14、链接地址再编辑（多渠道发布，批量替换推广链接。）；
15、自定义转换链接地址；

</pre>

@endsection

@section('js')
<script src='/js/about.js'></script>
@endsection
