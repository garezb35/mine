var _window = {};
$.extend(_window, {
    agent : null,
    browser : function () {
        var a = navigator.userAgent.toLowerCase();

        if (a.indexOf('firefox') > -1) { return 'F'; }
        else if (a.indexOf('safari') > -1) {
            if (a.indexOf('chrome') > -1) { return 'C'; }
            return 'S';
        }
        else if (a.indexOf('msie') > -1 || a.indexOf('trident') > -1) {
            if (a.indexOf('trident/7') > -1) { var v = 11; }
            else if (a.indexOf('trident/6') > -1) {
                if (a.indexOf('msie 10') > -1 || a.indexOf('msie 9') > -1 || a.indexOf('msie 7') > -1) { var v = 10; }
            }
            else if (a.indexOf('trident/5') > -1) {
                if (a.indexOf('msie 9') > -1 || a.indexOf('msie 7') > -1) { var v = 9; }
            }
            else if (a.indexOf('trident/4') > -1) {
                if (a.indexOf('msie 8') > -1 || a.indexOf('msie 7') > -1) { var v = 8; }
                if (a.indexOf('nt 6.1') > -1) { var v = '8_2'; }	// window7
            }
            else if (a.indexOf('msie 7') > -1) { var v = 7; }
            else { var v = 6; }

            return 'I' + v;
        }
        else { return 'E'; }
    },
    open : function (t, u, w, h, p, i) {	// title, url, width, height, policy, info
        var o = 'width=' + w + ', height=' + h;
        o += (!p) ? 'status=no, toolbar=no, menubar=no, location=no, fullscreen=no, scrollbars=yes, resizable=no, titlebar=no' : ',' + p;

        var a = window.open(u, t, o);
        if(a) {
            // this.center(a,w,h);
            this.resize(w, h, a);
            a.focus();
            if(i) {
                return a;
            }
        }
    },
    resize : function (w, h, p) {	// width, height, window
        if (!p) { p = window; }

        this.agent = this.browser();
        switch (this.agent) {
            case 'F': w += 18; h += 73; break;
            case 'C':
                p.resizeTo(w + 100, h + 100);
                w += 16;
                h += 68;
                break;
            case 'S':
                p.resizeTo(w + 100, h + 100);
                w += 16;
                h += 38;
                break;
            case 'I11': w += 20; h += 71; break;	// ì¡°ì •í•´ì•¼ í•¨
            case 'I10': w += 20; h += 71; break;
            case 'I9': w += 20; h += 71; break;
            case 'I8': w += 10; h += 78; break;
            case 'I8_2': w += 10; h += 83; break;
            case 'I7': w += 10; h += 78; break;
            case 'I6': w += 10; h += 54; break;
            default : w += 20; h += 72;
        }

        p.resizeTo(w, h);
        this.center(p, w, h);
    },
    center : function (p, w, h) {	// window, width, height
        if (!p) { p = window; }

        var s = {
            width : 0,
            height : 0
        };

        if(this.agent != null && this.agent.indexOf('I') > -1) {
            s.width = w;
            s.height = h;
            var x = (screen.availWidth - s.width) / 2;
            var y = (screen.availHeight - s.height) / 2;
        }
        else {
            s.width = p.outerWidth;
            s.height = p.outerHeight;
            var x = (screen.width - s.width) / 2;
            var y = (screen.height - s.height) / 2;
        }

        p.moveTo(x, y);
        p.focus();
    },
    close : function(w) {
        if(!w) { w = window; }
        w.close();
    }
});

