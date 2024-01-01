function cookiesEnabled(){
    var areCookiesEnabled = (navigator.cookieEnabled) ? true : false;
    if (typeof navigator.cookieEnabled == "undefied" && !areCookiesEnabled){
        document.cookie = "getCookie";
        areCookiesEnabled = (document.cookie.indexOf("getCookie") != - 1) ? true : false;
    }
    if (!areCookiesEnabled){
    	window.alert("Note: Cookies are disabled and some key features may not work properly. This website requires you to enable cookies in the browser."); 
    }
}