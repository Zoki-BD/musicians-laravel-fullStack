
function getJSP(url, div, before, after, popup)
{
    // alert(url);
    // alert(div);
    // alert(before);
    // alert(after);
    // alert(popup);
    // return false;
    // ce url-ju dodamo vedno nov parameter - Date(), se s tem izognemo problemu osvezevanja v IE
    //if ((url.indexOf(".php?") > -1))
    //{ url += '&date='+Date(); }
    //else { url += '?date='+Date(); }

    let ac = new ajaxCaller(url, div, before, after, popup);
    ac.load();
}



function ajaxCaller(klic, div, before, after, popup)
{
    this._klic = encodeURI(klic);
    this._div = div;
    this._before = before;
    this._after = after;
    this._popup = popup;
    //alert(this._klic)


    // alert(this._klic);
    // alert(this._div);
    // alert(this._before);
    // alert(this._after);
    // alert(this._popup);
    // return false;

}




ajaxCaller.prototype.load = function()
{

    let _this = this;
    this._xhr = this._getXMLHTTPRequest();
    this._before;// tuka se definira (ili povikuva) funkcijata sto se izveduva prva posle klikot
    // ===================================================================================================================================
    document.getElementById(this._div).innerHTML ="<i class=\"fa fa-spinner fa-spin\"></i>";
    // ===================================================================================================================================
    this._xhr.open("GET", this._generateDataUrl(), true);
    this._xhr.send(null);
    this._xhr.onreadystatechange = function()
    { _this._onData() };
}



ajaxCaller.prototype._generateDataUrl = function()
{
    "use strict";
    return this._klic; }



ajaxCaller.prototype._onData = function()
{
    "use strict";
    // alert(this._xhr.readyState );
    // return false;
    if (this._xhr.readyState == 4)
    {
        //if (this._xhr.status == 0) //ako e lokalno
        // alert(this._xhr.status );
        // return false;
        if (this._xhr.status == 200)
        {

            if (this._popup == 1) { document.getElementById(this._div).style.display = "block"; }

            document.getElementById(this._div).innerHTML = this._xhr.responseText;

            // tuka se definira (ili povikuva) funkcijata sto se izveduva posledna posle klikot
            eval(this._after);
        }
        else
        {
            document.getElementById(this._div).innerHTML = "Грешка во Ajax!"
        }
    }
};






//All modern browsers (IE7+, Firefox, Chrome, Safari, and Opera) have a built-in XMLHttpRequest object.
//Syntax for creating an XMLHttpRequest object:
//xmlhttp=new XMLHttpRequest();
//Old versions of Internet Explorer (IE5 and IE6) uses an ActiveX Object:
//xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

ajaxCaller.prototype._getXMLHTTPRequest = function()
{
    let xmlHttp;
    try
    {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        //xmlHttp = new ActiveXObject("Msxml2.XMLHttp");
    }
    catch (e)
    {
        try
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHttp");
        }
        catch (e2)
        {}
    }

    if (xmlHttp == undefined && (typeof XMLHttpRequest != 'undefined'))
    {
        xmlHttp = new XMLHttpRequest();
    }

    return xmlHttp;
};
