@extends('layouts.base')

@section('css')
<link rel='stylesheet' href='/css/admin.css'>
<link rel='stylesheet' href='/css/datatables.min.css'>
@endsection

@section('content')
<div ng-controller="AdminCtrl" class="ng-root">
    <div class='col-md-2'>
        <ul class='nav nav-pills nav-stacked admin-nav' role='tablist'>
            <li role='presentation' aria-controls="home" class='admin-nav-item active'><a href='#home'>用户中心</a></li>
            <li role='presentation' aria-controls="links" class='admin-nav-item'><a href='#links'>链接管理</a></li>
            <li role='presentation' aria-controls="settings" class='admin-nav-item'><a href='#settings'>设 置</a></li>

            @if ($role == $admin_role)
            <li role='presentation' class='admin-nav-item'><a href='#admin'>管理员</a></li>
            @endif

            @if ($api_active == 1)
            <li role='presentation' class='admin-nav-item'><a href='#developer'>开发者接口</a></li>
            @endif
        </ul>
    </div>
    <div class='col-md-10'>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h3 class='title'>使用步骤</h3>
                <p> 1、放入淘宝链接；</p>
                <p> 2、点击"生成微信跳转链接"按钮；</p>
                <p> 3、5秒之内生成的一个微信跳转淘宝短链接，同时能创建一个二维码！</p>
                <p> 4、放入微信引导粉丝到淘宝购买；</p>
                <p> 5、如推广宝贝要修改，可进入"用户中心"的"链接管理"修改宝贝地址；</p>
            <h3 class='title'>功能介绍（全功能免费，每天转换次数无上限。）</h3>
            <p>1、{{env('APP_NAME')}}是一个淘宝链接的的转换工具，主要用于帮助商家解决微信无法打开天猫、淘宝店铺的烦恼。</p>
            <p>2、店铺推广活动，推新品，微信公众号向店铺引流，只需要把淘宝链接做个转换，解决微信向淘宝引流难题！</p>
            <p>3、系统会帮助您统计出转换后的链接点击数据以及地区来源。</p>
            <p>4、所有商品页面地址转换；</p>
            <p>5、店铺首页地址转换；</p>
            <p>6、商品地址页转换；</p>
            <p>7、淘宝直播地址转换；</p>
            <p>8、优惠券地址转换；</p>
            <p>9、h5活动页面地址转换；</p>
            <p>10、美店装修页面地址转换；</p>
            <p>11、淘宝众筹页面地址转换；</p>
            <p>12、买家秀页面地址转换；</p>
            <p>13、数据统计功能；</p>
            <p>14、链接地址再编辑（多渠道发布，批量替换推广链接。）；</p>
            <p>15、自定义转换链接地址后缀；</p>

            </div>

            <div role="tabpanel" class="tab-pane" id="links">
                @include('snippets.link_table', [
                    'table_id' => 'user_links_table'
                ])
            </div>

            <div role="tabpanel" class="tab-pane" id="settings">
                <h3>修改密码</h3>
                <form action='/admin/action/change_password' method='POST'>
                    老密码：<input class="form-control password-box" type='password' name='current_password' />
                    新密码：<input class="form-control password-box" type='password' name='new_password' />
                    <input type="hidden" name='_token' value='{{csrf_token()}}' />
                    <input type='submit' class='btn btn-success change-password-btn'/>
                </form>
            </div>

            @if ($role == $admin_role)
            <div role="tabpanel" class="tab-pane" id="admin">
                <h3>链接</h3>
                @include('snippets.link_table', [
                    'table_id' => 'admin_links_table'
                ])

                <h3 class="users-heading">用 户</h3>
                <a ng-click="state.showNewUserWell = !state.showNewUserWell" class="btn btn-primary btn-sm status-display">添加用户</a>

                <div ng-if="state.showNewUserWell" class="new-user-fields well">
                    <table class="table">
                        <tr>
                            <th>用户名</th>
                            <th>密 码</th>
                            <th>Email</th>
                            <th>权限组</th>
                            <th></th>
                        </tr>
                        <tr id="new-user-form">
                            <td><input type="text" class="form-control" ng-model="newUserParams.username"></td>
                            <td><input type="password" class="form-control" ng-model="newUserParams.userPassword"></td>
                            <td><input type="email" class="form-control" ng-model="newUserParams.userEmail"></td>
                            <td>
                                <select class="form-control new-user-role" ng-model="newUserParams.userRole">
                                    @foreach  ($user_roles as $role_text => $role_val)
                                        <option value="{{$role_val}}">{{$role_text}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <a ng-click="addNewUser($event)" class="btn btn-primary btn-sm status-display new-user-add">添加</a>
                            </td>
                        </tr>
                    </table>
                </div>

                @include('snippets.user_table', [
                    'table_id' => 'admin_users_table'
                ])

            </div>
            @endif

            @if ($api_active == 1)
            <div role="tabpanel" class="tab-pane" id="developer">
                <h3>开发者</h3>

                <p>开发人员的API密钥和文档。</p>
                <p>
                    文档地址:
                    <a href='/pdf/API_Documentation.pdf' target="_blank">点击下载</a>
                </p>

                <h4>API Key: </h4>
                <div class='row'>
                    <div class='col-md-8'>
                        <input class='form-control status-display' disabled type='text' value='{{$api_key}}'>
                    </div>
                    <div class='col-md-4'>
                        <a href='#' ng-click="generateNewAPIKey($event, '{{$user_id}}', true)" id='api-reset-key' class='btn btn-danger'>Reset</a>
                    </div>
                </div>


                <h4>API 配额: </h4>
                <span> 每分钟请求数</span>
                <h2 class='api-quota'>
                    @if ($api_quota == -1)
                        unlimited
                    @else
                        <code>{{$api_quota}}</code>
                    @endif
                </h2>

            </div>
            @endif
        </div>
    </div>

    <div class="angular-modals">
        <edit-long-link-modal ng-repeat="modal in modals.editLongLink" link-ending="modal.linkEnding"
            old-long-link="modal.oldLongLink" clean-modals="cleanModals"></edit-long-link-modal>
        <creat-short-qr-modal ng-repeat="modal in modals.creatShortQr" link-ending="modal.linkEnding"
                              old-long-link="modal.oldLongLink" clean-modals="cleanModals"></creat-short-qr-modal>
        <edit-user-api-info-modal ng-repeat="modal in modals.editUserApiInfo" user-id="modal.userId"
            api-quota="modal.apiQuota" api-active="modal.apiActive" api-key="modal.apiKey"
            generate-new-api-key="generateNewAPIKey" clean-modals="cleanModals"></edit-user-api-info>
    </div>
</div>


@endsection

@section('js')
{{-- Include modal templates --}}
@include('snippets.modals')

{{-- Include extra JS --}}
<script src='/js/datatables.min.js'></script>
<script src='/js/api.js'></script>
<script src='/js/AdminCtrl.js'></script>
@endsection
