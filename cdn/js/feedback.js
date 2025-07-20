console.log('Feedback widget loaded');

document.write('<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>');

document.write('<div id="phpninja-widget" style="position:fixed;bottom:10px;right:10px;display:block; background:linear-gradient(145deg, #FFD700, #FFB700);border:1px solid ##FFD700;box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  color: black;font-weight:bold;border-radius:10px;padding-left:15px;padding-top:8px;padding-bottom:8px;padding-right:15px;font-family:Arial;font-size:13px;letter-spacing:0px;border:1px solid #e9e9e9;"><a style="display:inline-block;vertical-align:middle;" href="#" onclick="sendFeedback(event);">Sugerencias y Comentarios</a> <svg class="h-6 w-6 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" style="vertical-align:middle;width:15px;height:15px;display:inline-block;">           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />          </svg></div>');

function sendFeedback(e) {
    e.preventDefault();
    e.stopPropagation();
    if (feedback = window.prompt("👋 Tus comentarios son muy apreciados. Si necesitas una respuesta añade tu email o forma de contacto")) {
        postAjax("https://webhooks.gophpninja.com/feedback.php", {
            url: window.location.href,
            tag: 'feedback',
            msg: feedback,
            browser: detectBrowser()
        }, function (data) {
            // Trigger confetti effect
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
        });
        return true;
    } else {
        return false;
    }

}

function postAjax(url, data, success) {
    var params = typeof data == 'string' ? data : Object.keys(data).map(
        function (k) { return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]); }
    ).join('&');

    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
    xhr.open('POST', url);
    xhr.onreadystatechange = function () {
        if (xhr.readyState > 3 && xhr.status == 200) { success(xhr.responseText); }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}

function detectBrowser() {
    // Simple browser detection
    var ua = navigator.userAgent;
    if (ua.indexOf("Chrome") > -1) return "Chrome";
    if (ua.indexOf("Firefox") > -1) return "Firefox";
    if (ua.indexOf("Safari") > -1) return "Safari";
    if (ua.indexOf("MSIE") > -1 || !!document.documentMode) return "IE";
    return "Unknown";
}



// Function to get the current domain name without extension and capitalized
function getDomainName() {
    // Get the hostname
    const hostname = window.location.hostname.replace("www.", "");

    // Split the hostname by dots and take the first part
    const domainName = hostname.split('.')[0];

    // Capitalize the domain name
    const capitalizedDomainName = domainName.charAt(0).toUpperCase() + domainName.slice(1);

    return capitalizedDomainName;
}


