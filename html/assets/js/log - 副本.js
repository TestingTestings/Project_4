/**
 * Created by Administrator on 2016/10/10.
 */


function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + ";path=/"; // cookie 的跨域解决方案
}

function getCookie(name) {
    var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
    if (arr = document.cookie.match(reg))
        return unescape(arr[2]);
    else
        return null;
}

function delCookie(name) {
    setCookie(name, "", -1);
}


// 判断用户是否已登录
function user_online() {
    if (getCookie('userOnline')) { // 获取 cookie.userOnline
        cookie = getCookie('userOnline');
        console.log(cookie);
        $('#user_operation').text('注销').attr('href', '#'); // 切换 登录和注销
        show_user(cookie);

    } else {
        $('#user_operation').text('登录');
        hide_user();
    }
}

// 用户登录/注销
function user_operate(evt) {
    if ($(evt.target).text() == '登录') { // 点击登录 跳转至登录页
        location.href = "./login/login.html";
    } else if ($(evt.target).text() == '注销') { // 点击注销
        // 删除 userOnline
        delCookie('userOnline');
        // 刷新页面
        location.href = "./index.html";
    }
}

// 首页显示用户信息
function show_user(info) {
    $("#user_info").text(info).show();
    $("#search_history").show();

}

// 隐藏用户信息
function hide_user() {
    $("#user_info").text("").hide();
    $("#search_history").hide();
}
