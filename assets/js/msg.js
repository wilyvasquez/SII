var _0x208b=["\x25\x63\xA1\x44\x65\x74\x65\x6E\x74\x65\x21","\x66\x6F\x6E\x74\x2D\x66\x61\x6D\x69\x6C\x79\x3A\x20\x27\x3B\x41\x72\x69\x61\x6C\x27\x3B\x2C\x20\x73\x65\x72\x69\x66\x3B\x20\x66\x6F\x6E\x74\x2D\x77\x65\x69\x67\x68\x74\x3A\x20\x62\x6F\x6C\x64\x3B\x20\x63\x6F\x6C\x6F\x72\x3A\x20\x72\x65\x64\x3B\x20\x66\x6F\x6E\x74\x2D\x73\x69\x7A\x65\x3A\x20\x34\x35\x70\x78","\x6C\x6F\x67","\x25\x63\x45\x73\x74\x61\x20\x66\x75\x6E\x63\x69\xF3\x6E\x20\x64\x65\x6C\x20\x6E\x61\x76\x65\x67\x61\x64\x6F\x72\x20\x65\x73\x74\xE1\x20\x70\x65\x6E\x73\x61\x64\x61\x20\x70\x61\x72\x61\x20\x64\x65\x73\x61\x72\x72\x6F\x6C\x6C\x61\x64\x6F\x72\x65\x73\x2E\x20\x53\x69\x20\x61\x6C\x67\x75\x69\x65\x6E\x20\x74\x65\x20\x69\x6E\x64\x69\x63\xF3\x20\x71\x75\x65\x20\x63\x6F\x70\x69\x61\x72\x61\x73\x20\x79\x20\x70\x65\x67\x61\x72\x61\x73\x20\x61\x6C\x67\x6F\x20\x61\x71\x75\xED\x20\x70\x61\x72\x61\x20\x68\x61\x62\x69\x6C\x69\x74\x61\x72\x20\x75\x6E\x61\x20\x66\x75\x6E\x63\x69\xF3\x6E\x20\x6F\x20\x70\x61\x72\x61\x20\x50\x49\x52\x41\x54\x45\x41\x52\x20\x6C\x61\x20\x63\x75\x65\x6E\x74\x61\x20\x64\x65\x20\x61\x6C\x67\x75\x69\x65\x6E\x2C\x20\x73\x65\x20\x74\x72\x61\x74\x61\x20\x64\x65\x20\x75\x6E\x20\x66\x72\x61\x75\x64\x65\x2E","\x66\x6F\x6E\x74\x2D\x66\x61\x6D\x69\x6C\x79\x3A\x20\x27\x3B\x41\x72\x69\x61\x6C\x27\x3B\x2C\x20\x73\x65\x72\x69\x66\x3B\x20\x63\x6F\x6C\x6F\x72\x3A\x20\x62\x6C\x61\x63\x6B\x3B\x20\x66\x6F\x6E\x74\x2D\x73\x69\x7A\x65\x3A\x20\x32\x30\x70\x78"];function msg(){console[_0x208b[2]](_0x208b[0],_0x208b[1]);console[_0x208b[2]](_0x208b[3],_0x208b[4])}msg()
function show5()
{
    if (!document.layers&&!document.all&&!document.getElementById)
    return
      var Digital=new Date()
      var hours=Digital.getHours()
      var minutes=Digital.getMinutes()
      var seconds=Digital.getSeconds()
      var dn="PM"
    if (hours<12)
    {
      dn="AM";
    }
    if (hours>12)
    {
      hours=hours-12;
    }
    if (hours==0)
    {
      hours=12;
    }
    if (minutes<=9){
      minutes="0"+minutes;
    }
    if (seconds<=9)
    {
     seconds="0"+seconds
    }
    //change font size here to your desire
    myclock=hours+":"+minutes+":"+seconds+" "+dn;
    if (document.layers){
      document.layers.liveclock.document.write(myclock)
      document.layers.liveclock.document.close()
    }
    else if (document.all)
    {
      liveclock.innerHTML=myclock;          
    }
    else if (document.getElementById){
      document.getElementById("liveclock").innerHTML=myclock;
      setTimeout("show5()",1000);
    }
}
window.onload=show5