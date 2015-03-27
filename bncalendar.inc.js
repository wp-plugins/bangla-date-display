//Bangla calendar added to "Basic Calendar Java Script" -By Brian Gosselin @ http://scriptasylum.com
//and Bangla calendar created by Uttam Singha @ http://www.usingha.com
var mn = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
function buildCal(m, y, cM, cH, cDW, cD, brdr){
var bnum=['&#2535;']
var dim=[31,0,31,30,31,30,31,31,30,31,30,31];

var oD = new Date(y, m-1, 1); //DD replaced line to fix date bug when current day is 31st
oD.setTime(oD.getTime() + (oD.getTimezoneOffset() + 360) * 60 * 1000); 
    var bcal = Bangla_Date(y, m, 25);
    var bcal1 = Bangla_Date(y, m, 10);
oD.od=oD.getDay()+1; //DD replaced line to fix date bug when current day is 31st
var byy = (m == 4) ? convert((bcal[0]-1)) + '  ' + convert(bcal[0]) : convert(bcal[0]);
var todaydate = new Date() //DD added
todaydate.setTime(todaydate.getTime() + (todaydate.getTimezoneOffset() + 360) * 60 * 1000); 
var scanfortoday=(y==todaydate.getFullYear() && m==todaydate.getMonth()+1)? todaydate.getDate() : 0 //DD added

dim[1]=(((oD.getFullYear()%100!=0)&&(oD.getFullYear()%4==0))||(oD.getFullYear()%400==0))?29:28;
var t='<div class="'+cM+'"><table class="'+cM+'" cols="7" cellpadding="0" border="'+brdr+'" cellspacing="0"><tr align="center"><td colspan="2">'+beng_bc_month_name[bcal1[1]]+'</td><td colspan="3">'+ byy + '</td><td colspan="2">' + beng_bc_month_name[bcal[1]] + '</td><tr align="center">';
t+='<td colspan="7" align="center" class="'+cH+'">'+mn[m-1]+' - '+y+'</td></tr><tr align="center">';
t+='<tr align="center"><td>রবি</td>	<td>সোম</td><td>মঙ্গল</td><td>বুধ</td><td>বৃহঃ</td><td>শুক্র</td><td>শনি</td></tr><tr align="center">';
for(s=0;s<7;s++)t+='<td class="'+cDW+'">'+"SMTWTFS".substr(s,1)+'</td>';
t+='</tr><tr align="center">';
for(i=1;i<=42;i++){
var x=((i-oD.od>=0)&&(i-oD.od<dim[m-1]))? i-oD.od+1 : ' ';
    var indcal = Bangla_Date(y, m, i-oD.od+1);
	var indcal1 = indcal[2]==1? '<font size="3" color="#800000">' + convert(indcal[2]) + '</font>' :  convert(indcal[2])
	var xj=((i-oD.od>=0)&&(i-oD.od<dim[m-1]))? indcal1 : ' ';
if (x==scanfortoday) //DD added
x='<span id="today">'+x+'</span>' //DD added
t+='<td class="'+cD+'">'+x+'<br><span id="bangla">' + xj + '</span></td>';
if(((i)%7==0)&&(i<36))t+='</tr><tr align="center">';
}
return t+='</tr></table></div>';
}
var beng_bc_month_name = new Array;
beng_bc_month_name[1] 		= "বৈশাখ";
beng_bc_month_name[2] 		= "জ্যৈষ্ঠ";
beng_bc_month_name[3] 		= "আষাঢ়";
beng_bc_month_name[4] 		= "শ্রাবণ";
beng_bc_month_name[5] 		= "ভাদ্র";
beng_bc_month_name[6] 		= "আশ্বিন";
beng_bc_month_name[7] 		= "কার্তিক";
beng_bc_month_name[8] 		= "অগ্রহায়ন";
beng_bc_month_name[9] 		= "পৌষ";
beng_bc_month_name[10] 		= "মাঘ";
beng_bc_month_name[11] 		= "ফাল্গুন";
beng_bc_month_name[12] = "চৈত্র";

var bbc_month_len = "";


var Weekbc_days = new Array( "Sunday", "Monday", "Tuesday", "Wednesday",
                          "Thursday", "Friday", "Saturday");
var bWeekbc_days = new Array("রবি", "সোম", "মঙ্গল", "বুধ", "বৃহস্পতি", "শুক্র", "শনি", "রবি");
var bWeekbc_days1 = new Array("রবি", "সোম", "মঙ্গল", "বুধ", "বৃহ:", "শুক্র", "শনি", "রবি");


function convert(str) {
	var mystr =str.toString();
var outj;	// javascript escaped hex
var outj1;
var be = new Array();
be['1'] = "\u09E7";
be['2'] = "\u09E8";
be['3'] = "\u09E9";
be['4'] = "\u09EA";
be['5'] = "\u09EB";
be['6'] = "\u09EC";
be['7'] = "\u09ED";
be['8'] = "\u09EE";
be['9'] = "\u09EF";
be['0'] = "\u09E6";
be[' '] = '';
be['-'] = '-';
outj1="";
for(var i=0; i<mystr.length; i++)
{	
var ch = mystr.substr(i,1);
	outj  = be[ch];
	outj1+=outj;
}
return outj1;

}

var mas_len = [0, 30.92569444, 62.63289352, 94.00184028, 125.4761458, 156.4885417, 186.9247338, 216.8066667, 246.3155787, 275.6427546, 305.0935301, 334.9103588, 365.2587564814815];

function ModernDate_to_Julianeday(eyear, ebc_month, eday) {
    var julian_eday;

    if (ebc_month < 3) {
        eyear = eyear - 1;
        ebc_month = ebc_month + 12;
    }

    julian_eday = Math.floor((365.25 * eyear)) + Math.floor(30.59 * (ebc_month - 2)) + eday + 1721086.5;
    if (eyear < 0) {
        julian_eday = julian_eday - 1;
        if (((eyear % 4) == 0) && (3 <= ebc_month)) {
            julian_eday = julian_eday + 1;
        }
    }
    if (2299160 < julian_eday) {
        julian_eday = julian_eday + Math.floor(eyear * 1.0 / 400) - Math.floor(eyear * 1.0 / 100) + 2;
    }

    return julian_eday;
}

function Bangla_Date(eyear, ebc_month, eday) {
var country = "India";

    var str = "";
    var startjd = 0.0;
    if (country = "India") {
        startjd = 1938094.4629; //India
    }
    else {
        startjd = 1938094.483733333;
    }
    var nJD = ModernDate_to_Julianeday(eyear, ebc_month, eday);
    if (nJD < startjd) {
        str = " Date is not appropriate.\n";
    }
    else {
        var jddiff = nJD - startjd;
        var lasteyear = Math.floor(jddiff / 365.2587564814815);
        var mesh = startjd + lasteyear * 365.2587564814815;
        var lasteday = 0.0;
        var ps, ns, bebc_month, beday;
        for (var i = 0; i < 12; i++) {
            ps = mesh + mas_len[i];
            ns = mesh + mas_len[i + 1];
            if ((nJD >= ps) && (nJD <= Math.floor(ns) + 1.75)) {
                bebc_month = i + 1;
                beday = Math.floor(nJD - ps) + 1;
                //bbc_month_len =Math.floor(ns) + 0.5;
            }

        }
        var array = [];
          for (var i = 0; i < 12; i++)
                     {
                         lastday = mesh + mas_len[i];
                         var nda = new Date(calData(lastday + 1).toDateString());
                         array.push((nda.getMonth()+1) + "/" + nda.getDate() + "/" + nda.getFullYear());
                     }
                     bbc_month_len = array.join(",");

        //var bar = Math.floor(nJD + 0.5) % 7 + 1;
        //str = convert(beday) + " " + beng_bc_month_name[bebc_month] + " " + convert(lasteyear + 1) + " বঙ্গাব্দ, " + Weekebc_days[bar] + "বার।";

    }
    //return str;
     return new Array(lasteyear + 1, bebc_month, beday);

}
function oneDay() {
    var now = new Date();
    now.setTime(now.getTime() + (now.getTimezoneOffset() + 360) * 60 * 1000); 
    var eday= now.getDate();
    var ebc_month = now.getMonth();
    var eyear = now.getFullYear();
    var bcal = Bangla_Date(eyear, ebc_month + 1, eday);
    var nJD = ModernDate_to_Julianeday(eyear, ebc_month + 1, eday);
    var bar = Math.floor(nJD + 0.5) % 7 + 1;
    var str = convert(bcal[2]) + " " + beng_bc_month_name[bcal[1]] + " " + convert((bcal[0])) + " বঙ্গাব্দ, " + bWeekbc_days[bar] + "বার।";
    return str;
}
function formSubmit()
{
    var todaydate = new Date();
    todaydate.setTime(todaydate.getTime() + (todaydate.getTimezoneOffset() + 360) * 60 * 1000); 
var curyear=todaydate.getFullYear();
var myyear;
if ((document.bdcalendar.myear.value)<595) 
{ myyear =curyear;}
else 
{myyear=document.bdcalendar.myear.value;}
var bdcal="";
bdcal+='<table border="0" width="80%" id="table1" cellspacing="0" cellpadding="0">' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(1, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(2, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(3, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(4, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(5, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(6, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(7, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(8, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(9, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
	bdcal+='<tr valign="top">' ;
		bdcal+='<td>' + buildCal(10, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(11, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
		bdcal+='<td>' + buildCal(12, myyear, "bc_main", "bc_month", "bc_bc_daysofweek", "bc_days", 1) + '</td>' ;
	bdcal+='</tr>' ;
bdcal+='</table>' ;
document.all.vvv.innerHTML=bdcal;
}
//------------------------------------------------------------------------------------------
// Calendar day from Julian Day
//------------------------------------------------------------------------------------------
function calData(jd)
{
with(Math){
z1 = jd + 0.5;
z2 = floor(z1);
f = z1 - z2;
if(z2 < 2299161)a = z2;
else {
alf = floor((z2 - 1867216.25)/36524.25);
a = z2 + 1 + alf - floor(alf/4);
}
b = a + 1524;
c = floor((b - 122.1)/365.25);
d = floor(365.25*c);
e = floor((b - d)/30.6001);
bc_days = b - d - floor(30.6001*e) + f;
kday = floor(bc_days);
if(e < 13.5)kmon = e - 1;
else kmon = e - 13;
if(kmon > 2.5)kyear = c - 4716;
if(kmon < 2.5)kyear = c - 4715;
hh1 = (bc_days - kday)*24;
khr = floor(hh1);
kmin = hh1 - khr;
ksek = kmin*60;
kmin = floor(ksek);
ksek = floor((ksek - kmin)*60);
if (kday < 10)kday = " " + kday;
if (khr < 10)khr = "0" + khr;
if (kmin < 10)kmin = "0" + kmin;
if (ksek < 10)ksek = "0" + ksek;
var dstr = mn[kmon - 1] + " " + kday + ", " + kyear + " " + khr + ":" + kmin + ":00";
//var sDate = new Date(Date.parse("03/20/2012", "MM/dd/yyyy"));
s = new Date(dstr);

}
return s;
}

function BanglaMas() {
    var dynTable = "";
    var now = new Date();
    now.setTime(now.getTime() + (now.getTimezoneOffset() + 360) * 60 * 1000); 
    var day = now.getDate();
    var bc_month = now.getMonth();
    var year = now.getFullYear();
    var bcal = Bangla_Date(year, bc_month + 1, day);
    var mesh = 1938094.4629 + (bcal[0] - 1) * 365.2587564814815;
    var bar = calData(mesh + mas_len[bcal[1] - 1] + 1);
    var startingDay = bar.getDay();
    var one_day = 1000 * 60 * 60 * 24;
    var mr = bbc_month_len.split(",");
    var diff = Math.ceil((new Date(mr[bcal[1]]) - new Date(mr[bcal[1] - 1])) / (one_day));

    var bc_monthLength = diff;
    //bcal[2]
   var html = '<table class="gridtable">';
   html += '<tr><th colspan="7">';
   html += beng_bc_month_name[bcal[1]] + "&nbsp;" + convert((bcal[0])) + " বঙ্গাব্দ";
   html += '</th></tr>';
   html += '<tr>';
   for (var i = 0; i <= 6; i++) {
       html += '<td style=\"color: red; background: #99ff66; border: 1px solid black; font: 12px Siyam Rupali;\">';
       html += bWeekbc_days1[i];
       html += '</td>';
   }
   html += '</tr><tr>';
   var day = 1;
  // this loop is for is weeks (rows)
  for (var i = 0; i < 9; i++) {
    // this loop is for weekbc_days (cells)
    for (var j = 0; j <= 6; j++) { 
      html += '<td>';
      if (day <= bc_monthLength && (i > 0 || j >= startingDay)) {
          if (day == bcal[2]) //DD added
          {
              html += 'আজ<br><font size="3" color="red">' + convert(day) + '</font><br>'; //DD added
          }
          else {
              html += convert(day) + '<br>';
          }
      day++;
  }
  html += '</td>';
}
// stop making rows if we've run out of bc_days
if (day > bc_monthLength) {
    break;
} else {
    html += '</tr><tr>';
}
}
html += '</tr></table>';
return html;
}