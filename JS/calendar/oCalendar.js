
$.fn.oCalendar = function(options) {

    var formatter = 'MY';
    var generalStartDay = 0;
    var generalStartDay2 = 1;
    var dateToShow;
    var el;
    var width;
    var view = "month";
    var monthViewDayHeight;
    var data = new Array();
    var defaults = {
        startDay: 0,
        useAbbr : false,
        allowCud: true,
        url:''
    };

    var opts = $.extend(defaults, options);

    preloadImages();
    
    return this.each(function() {
        if(opts.startDay == 1){
            generalStartDay = 6;
            generalStartDay2 = 0;
        }
        if((opts.width+'').indexOf("%") != -1){
            width = opts.width;
        } else{
            width = opts.width+'px';
        }
        dateToShow = new Date();

        el = $(this);
        prepareCanvas();
    });

    function prepareCanvas(){
        el.width(width);
        var w = el.width();
        el.height(opts.height);
        
        var html = '<div class="container">\
                        <div class="smallCalContainer">'+getSmallCalendarHtmlMonthView()+'\
                        </div>\
                        <div style="float:right; width:'+(w-180)+'px;">\
                            <div class="bigCalHeader">\
                                <div class="showDate">'+format(dateToShow,' ')+'</div>\<div style="clear:both;"/>\
                            </div>\
                            <div class="bigCal">'+getCalendarHtmlMonthView()+'\
                        </div>\
                    </div>';
        el.html(html);

        el.find(".monthViewDayClick").click(function(e){
            addListenerDayClicks(e, $(this), 'monthMore');
        });
        
        el.find(".prevMonth").click(function(){
            showDate(this.title);
        });

        el.find(".nextMonth").click(function(){
            showDate(this.title);
        });

        el.find(".monthLink").click(function(){
            changeSmallCalendarView(this.title);
        });

        el.find(".monthShow").click(function(){
            changeBigCalendarView($(this));
        });

        loadData(start, end);
    }

    function addListenerDayClicks(e, elem , viewClassName){
        var clicked = e.target;
        if(clicked.className == 'editEvent'){
            editShowModal($(clicked));
            e.stopPropagation();
            return;
        } else if(clicked.className == viewClassName+' event'){
            showListModal($(clicked));
            e.stopPropagation();
            return;
        }
    }
    
    function getSearchDiv(){
        var html = '<div class="searchDiv">\
                        <div><input class="searchInput" type="text" value="search event"/></div>\
                        <div id="searchResult"></div>\
                    </div>';
        return html;
    }

    function preloadImages(){
        var pic2= new Image();
        pic2.src ="JS/calendar/img/close.png";
    }
    
    function format(date, seperator) {
        var gun = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
        var ay = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1);
        var fullay = month[date.getMonth()];
        var fullyear = date.getFullYear() + '';
        var year = fullyear.substr(2, 3);
        var a = formatter.substr(0, 1);
        var b = formatter.substr(1, 1);
        var c = formatter.substr(2, 3);
        var first = '';
        var second = '';
        var third = '';
        if (a == 'd') {
            first = gun;
            if (b == 'm') {
                second = ay;
                if (c == 'y') {
                    third = year;
                } else if (c == 'Y') {
                    third = fullyear;
                }
            } else if (b == 'M') {
                second = fullay;
                if (c == 'y') {
                    third = year;
                } else if (c == 'Y') {
                    third = fullyear;
                }
            } else if (b == 'y') {
                second = year;
                if (c == 'm') {
                    third = ay;
                } else if (c == 'M') {
                    third = fullay;
                }
            } else if (b == 'Y') {
                second = fullyear;
                if (c == 'm') {
                    third = ay;
                } else if (c == 'M') {
                    third = fullay;
                }
            }
        } else if (a == 'm') {
            first = ay;
            if (b == 'd') {
                second = gun;
                if (c == 'y') {
                    third = year;
                } else if (c == 'Y') {
                    third = fullyear;
                }
            } else if (b == 'y') {
                second = year;
                if (c == 'd') {
                    third = gun;
                }
            } else if (b == 'Y') {
                second = fullyear;
                if (c == 'd') {
                    third = gun;
                }
            }
        } else if (a == 'M') {
            first = fullay;
            if (b == 'd') {
                second = gun;
                if (c == 'y') {
                    third = year;
                } else if (c == 'Y') {
                    third = fullyear;
                }
            } else if (b == 'y') {
                second = year;
                if (c == 'd') {
                    third = gun;
                }
            } else if (b == 'Y') {
                second = fullyear;
                if (c == 'd') {
                    third = gun;
                }
            }
        } else if (a == 'y') {
            first = year;
            if (b == 'd') {
                second = gun;
                if (c == 'y') {
                    third = year;
                } else if (c == 'Y') {
                    third = fullyear;
                }
            } else if (b == 'm') {
                second = ay;
                if (c == 'd') {
                    third = gun;
                }
            } else if (b == 'M') {
                second = fullay;
                if (c == 'd') {
                    third = gun;
                }
            }
        } else if (a == 'Y') {
            first = fullyear;
            if (b == 'd') {
                second = gun;
                if (c == 'y') {
                    third = year;
                } else if (c == 'Y') {
                    third = fullyear;
                }
            } else if (b == 'm') {
                second = ay;
                if (c == 'd') {
                    third = gun;
                }
            } else if (b == 'M') {
                second = fullay;
                if (c == 'd') {
                    third = gun;
                }
            }
        }
        return first + seperator + second + seperator + third;
    }

    function getSmallCalendarHtmlMonthView(){
        var index = 0;
        var year = dateToShow.getFullYear();
        var month1 = dateToShow.getMonth()-1;
        if(dateToShow.getMonth() == 0){
            year --;
            month1 = 11;
        }
        var lastSunday = getLastSunday(month1, year);
        var lastDateLastMonth = getLastDate(month1, year);
        var lastDateThisMonth = getLastDate(dateToShow.getMonth(), year);
        var daysToWrite = getDaysToWrite(lastSunday,lastDateLastMonth,lastDateThisMonth, dateToShow.getMonth());
        var dayHeight = 20;
        var dayWidth = 20;

        var prevMonth = new Date();
        prevMonth.setDate(1);
        var nextMonth = new Date();
        nextMonth.setDate(1);

        
        prevMonth.setMonth(dateToShow.getMonth());
        prevMonth.setYear(dateToShow.getFullYear());

        nextMonth.setMonth(dateToShow.getMonth());
        nextMonth.setYear(dateToShow.getFullYear());

        prevMonth.setMonth(prevMonth.getMonth()-1);
        nextMonth.setMonth(nextMonth.getMonth()+1);
        
        var prevStr = prevMonth.getDate()+'-'+(prevMonth.getMonth())+'-'+prevMonth.getFullYear();
        var nextStr = nextMonth.getDate()+'-'+(nextMonth.getMonth())+'-'+nextMonth.getFullYear();

        var html = '<table class="smallCalendar" cellspacing="0" cellpadding="0">\
                    <tr>\
                        <td class="header" colspan="5" style="text-align:left; padding-left:5px;"><a class="monthLink" title="monthView" href="javascript:void(0);">'+format(dateToShow,' ')+'</a></td>\
                        <td class="header" style="padding-left:3px; text-align:left;"><a class="linkk prevMonth" href="javascript:void(0);" title="'+prevStr+'">&lt;</a></td>\
                        <td class="header" style="padding-right:3px; text-align:right;"><a class="linkk nextMonth" href="javascript:void(0);" title="'+nextStr+'">&gt;</a></td>\
                    </tr>';
        html += '<tr>';
        if(opts.startDay == 0){
            for(var m=0; m<7; m++){
                html += '<td style="height:'+dayHeight+'px; width:'+dayWidth+'px;">\
                    '+daysAbbr[m]+'\
                </td>';
            }
        } else{
            var day2 = daysAbbr[6];
            html += '<th>\
                    '+day2+'\
                </th>';
            for(var m=0; m<6; m++){
                html += '<th style="height:'+dayHeight+'px; width:'+dayWidth+'px;">\
                    '+daysAbbr[m]+'\
                </th>';
            }
        }
        html += '</tr>';
        for(var i = 0; i<6; i++){
            var stt = '';
            var arr1 = daysToWrite[index].split("-");
            stt = arr1[4];
            html += '<tr class="weekShow" lang="'+stt+'">';
            for(var j=0; j<7; j++){
                var arr2 = daysToWrite[index].split("-");
                var write = arr2[0];
                var red = '';
                var background = '';
                if(arr2[2]){
                    red = 'color:red;';
                    background = 'background-color:#FFF7D7;';
                }
                if(arr2[3] != 'a'){
                    background = 'color:#AAAAAA;';
                }
                var paddingStr = 'padding-right:5px;';
                html += '<td class="weekDays" style="height:'+dayHeight+'px; width:'+dayWidth+'px; '+paddingStr+'; '+red+' '+background+'">\
                    '+write+'\
                </td>';
                index ++;
            }
            html += '</tr>';
        }
        html += '</table>';
        return html;
    }

    function getSmallCalendarHtmlYearView(){
        var index = 0;
        
        var dayHeight = 35;
        var dayWidth = 25;

        var prevMonth = new Date(dateToShow.getFullYear(),dateToShow.getMonth(),dateToShow.getDate());
        var nextMonth = new Date(dateToShow.getFullYear(),dateToShow.getMonth(),dateToShow.getDate());

        var prevStr = prevMonth.getFullYear()-1;
        var nextStr = nextMonth.getFullYear()+1;

        var html = '<table class="smallCalendar" cellspacing="0" cellpadding="0" style="width:100%; text-align:right; font-size:11px;">\
                    <tr>\
                        <td colspan="2" class="header" style="text-align:left; padding-left:5px;"><a class="ilink monthLink" title="monthView" href="javascript:void(0);">'+format(dateToShow,' ').split(" ")[1]+'</a></td>\
                        <td class="header" style="padding-right:3px; text-align:right;"><a style="padding-right:2px;" class="linkk prevYear" href="javascript:void(0);" title="'+prevStr+'">&lt;</a><a style="padding-left:2px;" class="linkk nextYear" href="javascript:void(0);" title="'+nextStr+'">&gt;</a></td>\
                    </tr>';
        for(var i = 0; i<4; i++){
            html += '<tr>';
            for(var j=0; j<3; j++){
                var write = monthAbbr[index];
                var paddingStr = 'padding-right:5px;';
                html += '<td style="font-size:14px; text-align:center; height:'+dayHeight+'px; width:'+dayWidth+'px; '+paddingStr+';">\
                    <a class="ilink monthLinkS" href="javascript:void(0);" title="'+index+'">'+write+'</a>\
                </td>';
                index ++;
            }
            html += '</tr>';
        }
        html += '</table>';
        return html;
    }

    function getCalendarHtmlMonthView(){
        var index = 0;
        var year = dateToShow.getFullYear();
        var month1 = dateToShow.getMonth()-1;
        if(dateToShow.getMonth() == 0){
            year --;
            month1 = 11;
        }
        var lastSunday = getLastSunday(month1, year);
        var lastDateLastMonth = getLastDate(month1, year);
        var lastDateThisMonth = getLastDate(dateToShow.getMonth(), year);
        var daysToWrite = getDaysToWrite(lastSunday,lastDateLastMonth,lastDateThisMonth, dateToShow.getMonth());
        var dayHeight = (opts.height-43)/6;
        var dayWidth = 100/8;
        var html = '<table cellspacing="0" cellpadding="0" class="bigCalTable">';
        html += '<tr>'+getDays()+'</tr>';

        start = daysToWrite[0].split("-")[4].replace(/_/g,"-");
        end = daysToWrite[daysToWrite.length-1].split("-")[4].replace(/_/g,"-");
        monthViewDayHeight = (dayHeight-20);
        for(var i = 0; i<6; i++){
            html += '<tr>';
            for(var j=0; j<7; j++){
                var arr =  daysToWrite[index].split('-');
                var write = opts.useAbbr ? arr[0] : arr[0]+' '+arr[1];
                var rel = arr[0]+'_'+arr[5];
                var dayClick = arr[4];
                var classi = '';
                var colcol = '';
                if(arr[2]){
                    classi = 'bigCalToday';
                    colcol = 'color:black;';
                }
                if(arr[3]  != 'a'){
                    classi = 'bigCalDay';
                }
                html += '<td style="height:'+dayHeight+'px; width:'+dayWidth+'%;">\
                    <div class="dayDaysLink" rel="'+rel+'" title="dayView">'+write+'</div>\
                    <div id="'+dayClick+'" class="monthViewDayClick '+classi+'" style="'+colcol+' height:'+(dayHeight-20)+'px;" rel="'+dayClick+'"></div>\
                </td>';
                index ++;
            }
            html += '</tr>';
        }
        html += '</table>';
        return html;
    }

    function getDays(){
        var html = '';
        if(opts.startDay == 0){
            for(var j=0; j<7; j++){
                var day = opts.useAbbr ? daysAbbr[j] : days[j];
                html += '<th class="monthViewDayClickClass">\
                    '+day+'\
                </th>';
            }
        } else{
            var day2 = opts.useAbbr ? daysAbbr[6] : days[6];
            html += '<th class="monthViewDayClickClass">\
                    '+day2+'\
                </th>';
            for(var j=0; j<6; j++){
                var day = opts.useAbbr ? daysAbbr[j] : days[j];
                html += '<th class="monthViewDayClickClass">\
                    '+day+'\
                </th>';
            }
        }

        return html;
    }

    function getDaysWeek(array){
        var html = '';
        for(var j=0; j<array.length; j++){
            var arr= array[j].split(' ');
            var ay = monthAbbr[arr[2]];
            html += '<th class="weekDaysLink" title="dayView" rel="'+arr[0]+'_'+arr[2]+'">\
                '+arr[0]+' '+ay+' '+arr[1]+'\
            </th>';
        }

        return html;
    }

    function getLastSunday(monthh, year){
        var lastFriday = 0;

        var da = new Date(year,monthh,20);
        while(true){
            if(da.getDay() == generalStartDay){
                if(da.getMonth() != monthh){
                    break;
                } else{
                    lastFriday = da.getDate();
                    da.setDate(da.getDate()+1);
                }
            } else {
                da.setDate(da.getDate()+1);
            }
        }
        return lastFriday
    }

    function getLastSundayFromNow(){
        var lastFriday = 0;
        var y = dateToShow.getFullYear();
        var m = dateToShow.getMonth();
        var da = new Date(y,m, (dateToShow.getDate()-1));
        var lastDate = getLastDate(m, y);
        for(var i=0;i<=lastDate; i++){
            if(da.getDay() == generalStartDay){
                lastFriday = da.getDate();
                break;
            } else {
                da.setDate(da.getDate()-1);
            }
        }
        return lastFriday
    }

    function getLastDate(monthh, year){
        var lastDay = 0;
        var da = new Date(year,monthh,27);
        while(true){
            if(da.getMonth() != monthh){
                break;
            } else {
                lastDay = da.getDate();
                da.setDate(da.getDate()+1);
            }
        }
        return lastDay;
    }

    function getDaysToWrite(lastSunday,lastDateLastMonth,lastDateThisMonth, thisMonth){
        var array = new Array();
        var j = 0;
        var p = 1;
        var today = new Date();
        var str = '';
        var dd;
        var year = dateToShow.getFullYear();

        var pre = thisMonth-1;
            if(pre == -1){
                year--;
        }
        for(var i = lastSunday+1; i <= lastDateLastMonth; i++){
            pre = thisMonth-1;
            if(pre == -1){
                pre = 11;
            }
            if(today.getMonth() == pre){
                if(today.getDate() == i && today.getMonth() == thisMonth){
                    str = '@';
                }
            }
            dd = i+'_'+pre+'_'+year;
            array[j] = i+'-'+month[pre]+'-'+str+'-#-'+dd+'-'+pre;
            str = '';
            j++;
        }
        pre = thisMonth-1;
        
        if(pre == -1){
            year++;
        }
        for(i = 1 ; i < lastDateThisMonth+1; i++){
            str = '';
            if(today.getMonth() == thisMonth){
                if(today.getDate() == i){
                    str = '@';
                }
            }
            dd = i+'_'+thisMonth+'_'+year;
            array[j] = i+'-'+month[thisMonth]+'-'+str+'-a-'+dd+'-'+thisMonth;
            str = '';
            j++;
        }

        var nex = thisMonth+1;
        if(nex == 12){
            year ++;
        }
        for(i = j ; i < 42; i++){
            str = '';
            nex = thisMonth+1;
            if(nex == 12){
                nex = 0;
            }
            if(today.getMonth() == nex){
                if(today.getDate() == i && today.getMonth() == thisMonth){
                    str = '@';
                }
            }
            dd = p+'_'+nex+'_'+year;
            array[i] = p+'-'+month[nex]+'-'+str+'-'+'#-'+dd+'-'+nex;
            str = '';
            p++;
            j++;
        }
        return array;
    }

    function getDaysToWriteWeek(lastSunday, lastDateLastMonth, lastDateThisMonth){
        var array = new Array();
        var index = 0;
        var p = 0;
        var monthStr = '';

        if(lastSunday > dateToShow.getDate()){
            //gecen hafta sonu geçen ay ise

            //bu ayin basina kadar gecen ayi say
            for(var i=lastSunday; i<lastDateLastMonth; i++){
                var m = dateToShow.getMonth();
                var dd = lastSunday+(p+1)+'_'+m+'_'+dateToShow.getFullYear();
                monthStr = daysAbbr[index];
                array[index] = lastSunday+(p+1)+' '+monthStr+' '+m+' '+dd;
                index ++;
                p++;
            }

            p = 0;

            if(dateToShow.getDay() == generalStartDay2){
                dateToShow.setMonth(dateToShow.getMonth()-1);
            }

            //bu aydan 7ye tamamla
            for(var j=index; j<7; j++){
                var m = dateToShow.getMonth();
                var dd = (p+1)+'_'+((m+1)%12)+'_'+dateToShow.getFullYear();
                monthStr = daysAbbr[index];
                array[j] = (p+1)+' '+monthStr+' '+((m+1)%12)+' '+dd;
                index ++;
                p ++;
            }
        } else{
            //gecen haftasonu bu ayda ise

            if(dateToShow.getDate()+7 > lastDateThisMonth){
                //7 gun sonrasi onumuzdeki ayda ise

                //bu ayin sonuna kadar say
                for(var n=lastSunday; n<lastDateThisMonth; n++){
                    var m = dateToShow.getMonth();
                    var dd = lastSunday+(p+1)+'_'+m+'_'+dateToShow.getFullYear();
                    monthStr = daysAbbr[index];
                    array[index] = lastSunday+(p+1)+' '+monthStr+' '+m+' '+dd;
                    index ++;
                    p++;
                }
                p = 0;

                //bu haftayı onumuzdeki ay ile 7ye tamamla
                for(var v=index; v<7; v++){
                    var year = dateToShow.getFullYear();
                    var m =dateToShow.getMonth();
                    if(m+1 == 12){
                        year ++;
                    }
                    var dd = (p+1)+'_'+((m+1)%12)+'_'+year;
                    monthStr = daysAbbr[index];
                    array[index] = (p+1)+' '+monthStr+' '+((m+1)%12)+' '+dd;
                    index ++;
                    p ++;
                }
            } else{
                //hafta ayni ayin icinde ise 7 gunu de bu aydan say
                for(var k=0; k<7; k++){
                    var m = dateToShow.getMonth();
                    var dd = lastSunday+(k+1)+'_'+m+'_'+dateToShow.getFullYear();
                    monthStr = daysAbbr[index];
                    array[index] = lastSunday+(k+1)+' '+monthStr+' '+m+' '+dd;
                    index ++;
                }
            }
        }
        return array;
    }

    function showDate(str){
        var d1 = new Date(str.split("-")[2],str.split("-")[1],str.split("-")[0]);
        dateToShow = d1;
        changeSmallCalendarView('dayView');
    }

    function changeSmallCalendarView(str){
        var parent = el.find(".smallCalendar").parent();
        if(str == 'dayView'){
            parent.html(getSmallCalendarHtmlMonthView());
            el.find(".prevMonth").click(function(){
                showDate(this.title);
            });

            el.find(".nextMonth").click(function(){
                showDate(this.title);
            });

            el.find(".monthLink").click(function(){
                changeSmallCalendarView(this.title);
            });

        } else if(str == 'monthView'){
            parent.html(getSmallCalendarHtmlYearView());
            
            el.find(".smallCalendar").find(".monthLinkS").click(function(){
                var str = this.title;
                dateToShow.setMonth(str);
                changeSmallCalendarView("dayView");
                el.find(".bigCal").html(getCalendarHtmlMonthView());
                el.find(".showDate").html(format(dateToShow,' '));
                el.find(".monthViewDayClick").click(function(e){
                    addListenerDayClicks(e, $(this), 'monthMore');
                });
                view = "month";
                loadData(start, end);
            });

            el.find(".prevYear").click(function(){
                var str = this.title;
                dateToShow.setYear(str);
                changeSmallCalendarView("monthView");
            });

            el.find(".nextYear").click(function(){
                var str = this.title;
                dateToShow.setYear(str);
                changeSmallCalendarView("monthView");
            });
        }
    }

    function changeBigCalendarView(elem){
        var html = '';
        var parent = el.find(".bigCal");
        var  str = elem.attr("title");
        var dd = elem.attr("lang");
        var rel = elem.attr("rel");
        if(str == 'weekView'){
            view = "week";
            if(dd == ''){
                var m = dateToShow.getMonth();
                var year = dateToShow.getFullYear();
                var dat = new Date(year, m ,dateToShow.getDate());
                dat.setMonth(dat.getMonth()-1);

                var month1 = m-1;
                if(m == 0){
                    year --;
                    month1 = 11;
                }

                var ls = getLastSunday(month1,year);
                dat.setDate((ls+1));

                var daa = new Date(dat.getFullYear(),dat.getMonth(),dat.getDate());
                dateToShow = daa;
                
                html = getCalendarHtmlWeekView();
                parent.html(html);
                $(".weekDaysLink").die().live("click",function(){
                    changeBigCalendarView($(this));
                });
                $('.weekViewDayClick').die().live('click',function(e){
                    var el = e.target;
                    //week bas
                    if(el.className == 'weekMore'){
                        showListModal($(el));
                        e.stopPropagation();
                        return;
                    }
                    showModal($(this).attr("rel"), $(this));
                });
                loadData(start, end);
            } else{
                var daa = new Date(dd.split("_")[2],dd.split("_")[1],dd.split("_")[0]);
                dateToShow = daa;
                html = getCalendarHtmlWeekView();
                parent.html(html);
                $(".weekDaysLink").die().live("click",function(){
                    changeBigCalendarView($(this));
                });
                $('.weekViewDayClick').die().live('click',function(e){
                    var el = e.target;
                    //week bas
                    if($(el).attr('class') == 'weekMore'){
                        showListModal($(el));
                        e.stopPropagation();
                        return;
                    }
                    showModal($(this).attr("rel"), $(this));
                });
                loadData(start, end);
            }
        } else if(str == 'monthView'){
            view = "month";
            html = getCalendarHtmlMonthView();
            parent.html(html);
            $(".dayDaysLink").die().live("click",function(){
                    //changeBigCalendarView($(this));
            });
            $(".monthViewDayClick").click(function(e){
                addListenerDayClicks(e, $(this), 'monthMore');
            });
            loadData(start, end);
        } else if(str == 'dayView'){
            view = "day";
            if(rel == ''){
                html = getCalendarHtmlDayView();
                parent.html(html);
                $(".dayViewDayClick").die().live("click", function(e){
                    addListenerDayClicks(e, $(this), 'dayMore');
                });
                loadData(start, end);
            } else{
                var daa = new Date(dateToShow.getFullYear(),rel.split("_")[1],rel.split("_")[0]);
                dateToShow = daa;

                html = getCalendarHtmlDayView();
                parent.html(html);

                $(".dayViewDayClick").die().live("click", function(e){
                    addListenerDayClicks(e, $(this), 'dayMore');
                });
                loadData(start, end);
            }
        }
        $(".showDate").html(format(dateToShow,' '));
    }

    function closeModal(){
        $(".modal").remove();
    }

    function getClockRange(sa,edit){
        if(edit){
            edit = true;
        } else{
            edit = false;
        }
        var clockRange;
        if(sa.indexOf(":") == -1){
            if(sa == 'am'){
                clockRange = ["00:00","11:59"];
            } else{
                clockRange = ["12:00","23:59"];
            }
        }else{
            var arr = sa.split(":");
            var ss = arr[0];
            if(!edit){
                var dk = arr[1].substr(0, 1);
                if(dk == '0'){
                    clockRange = [ss+":00",ss+":29"];
                } else{
                    clockRange = [ss+":30",ss+":59"];
                }
            }else{
                var dkk = sa.indexOf("0") == 0 ? parseInt(sa.substr(1, 1)) : parseInt(sa);
                var sss = ss.indexOf("0") == 0 ? parseInt(ss.substr(1, 1)) : parseInt(ss);
                var saa =(sss>=0 && sss<12 ? "00" : "12");
                var saa2 =(sss>=0 && sss<12 ? "11" : "23");
                if(dkk >=0 && dkk < 30){
                    clockRange =[saa+":00", saa2+":59"];
                } else{
                    clockRange = [saa+":30",saa2+":59"];
                }
            }
        }
        return clockRange;
    }

    function getOptionHtml(range, t, disabled){
        var html = '';
        var selSa = '';
        var selDa = '';
        if(t){
            var arr = t.split(":");
            selSa = arr[0];
            selDa = arr[1];
        }

        var arr1 = range[0].split(":");
        var arr2 = range[1].split(":");

        var saMin = arr1[0];
        var saMax = arr2[0];

        var daMin = arr1[1];
        var daMax = arr2[1];

        html += '<select id="hour" '+disabled+'>';
        var hoMin = parseInt(saMin.indexOf(0) == 0 ? saMin.substr(1,1) : saMin);
        var hoMax = parseInt(saMax.indexOf(0) == 0 ? saMax.substr(1,1) : saMax);
        for(var i = hoMin; i<= hoMax; i++){
            var val = parseInt(i/10) == 0 ? "0"+i : i;
            var sell = "";
            if(selSa == val){
                sell = "selected";
            }
            html += '<option '+sell+' value="'+val+'">'+val+'</option>';
        }
        html += '</select>';

        html += '<select id="minute" '+disabled+' style="margin-left:10px;">';
        var miMin = parseInt(daMin);
        var miMax = parseInt(daMax);
        for(var j = miMin; j<= miMax; j++){
            var val = parseInt(j/10) == 0 ? "0"+j : j;
            var sell2 = "";
            if(selDa == val){
                sell2 = "selected";
            }
            html += '<option '+sell2+' value="'+val+'">'+val+'</option>';
        }
        html += '</select>';

        return html;
    }

    /*
    DATA SECTION
     */

    function MyEvent(id, ack, date, time, etime){
        this.id = id;
        this.ack = ack;
        this.date = date;
        this.time = time;
        this.etime = etime;
    }

    function addToDom(elem, myEvent){
        var html = "";
        var divSize = elem.find(".event").size();
        var color = myEvent.ack == "פגישה פנויה" ? "rgb(91, 253, 102)" : "rgb(253, 91, 91)";
        if(divSize < 2){
            html += '<div id="event-'+myEvent.id+'" class="event" style="color:black;background-color:'+color+';">\
                <div class="eventAck" style="width: 100%; font-size: 9pt;">&nbsp;&nbsp;&nbsp;'+myEvent.ack.substr(0,20)+'</div>\
            </div><div style="clear:both;"/>';
            elem.append(html);
        }
        divSize = elem.find(".event").size();
        var height = monthViewDayHeight;
        elem.find(".event").height(25);
        elem.find(".monthMore").height(elem.find(".monthMore").height()-3);
        elem.find(".monthMore").width("43px");        
    }

    function addData(myEvent){
        data[data.length] = myEvent;
    }

    function jsonToData(json){
        data = new Array();
        for(var i=0; i<json.length; i++){
            var ev = json[i];
            var arr = ev.date.split("-");
            var d = arr[0].substr(0,1) == '0' ? arr[0].substr(1,1) : arr[0];
            var mi = arr[1].substr(0,1) == '0' ? arr[1].substr(1,1) : arr[1];
            var m = parseInt(mi)-1;
            var y = arr[2];

            var ddd = d+'-'+m+'-'+y;

            var myEvent = new MyEvent(ev.id, ev.ack, ddd, ev.time);
            addData(myEvent);
        }
    }

    function processData(){
        $(".dayViewDayClick").html('');
        $(".weekViewDayClick").html('');
        $(".monthViewDayClick").html('');
        
        for(var i=0; i<data.length; i++){
            var myEvent = data[i];
            var ids = myEvent.date.replace(/-/g,"_");
            var time = myEvent.time;
            var latter;
            var arr = time.split(":");
            if(view == 'month'){
                latter = parseInt(arr[0])>-1 && parseInt(arr[0]) < 12 ? "": "";
            }
            ids += latter;
            var elem = $("#"+ids);
            if(elem.length != 0){
                addToDom(elem, myEvent);
            }
        }
        console.log(data.length);
        for(let j=0; j<data.length; j++){
            console.log(j);
            var myEvent = data[j];
            var ids = myEvent.date.replace(/-/g,"_");
            var elem = $("#"+ids);
            if(!elem[0].innerHTML.includes('צפה'))
            {
                html = '<div class="monthMore event" rel="'+elem[0].id+'">צפה בהכל</div>';
                elem.append(html);
            }
        }
    }

    function loadData(s, e){

        var arr = s.split("-");
        var d = arr[0];
        var m = parseInt(arr[1])+1;
        var y = arr[2];

        var start1 = d+'-'+m+'-'+y;

        var arr1 = e.split("-");
        d = parseInt(arr1[0])+1;
        m = parseInt(arr1[1])+1;
        y = arr1[2];

        var end1 = d+'-'+m+'-'+y;

        $.ajax({
            url: opts.url,
            type:'POST',
            async: false,
            dataType: 'json',
            data: "function=load&start="+start1+" 00:00&end="+end1+" 00:00",
            success: function(resp){
                jsonToData(resp);
                processData();
            }
        });
    }

    /*
    END DATA SECTION
     */

    function dateToJava(s){
        var arr = s.split("-");
        var d = arr[0];
        var m = parseInt(arr[1])+1;
        var y = arr[2];

        return d+'-'+m+'-'+y;
    }

    function dateToJavaScript(s){
        var arr = s.split("-");
        var d = arr[0];
        var m = parseInt(arr[1])-1;
        var y = arr[2];

        return d+'-'+m+'-'+y;
    }

    function unserialize(Data){
        var Data = Data.split("&");
        var Serialised = new Array();
        $.each(Data, function(){
            var Properties = this.split("=");
            Serialised[Properties[0]] = Properties[1];
        });
        return Serialised;
    }

    function decode(str) {
        var encoded = str;
        return decodeURIComponent(encoded.replace(/\+/g, " "));
    }

    function showListModal(el, str){
        var dayy;
        var monthh;
        var yearr;
        if(el != undefined){
            var rel = el.attr("rel");
            var s;
            var e;
            var me = getStartEnd(rel);

            var arr = rel.split("_");
            dayy = arr[0];
            monthh = month[arr[1]];
            yearr = arr[2];

            var arr2 = me.split("|");
            s = arr2[0];
            e = arr2[1];
        } else{
            dayy = resultStr;
            monthh = '';
            yearr = '';
        }
        var html = '<div class="modal modalBack" style="display:none;">\
        </div>\
        <div class="modal">\
            <div class="modalContainer">\
                <div class="glow">\
                    <div class="hider">\
                        <div class="modalTop">\
                            <div class="modalDateToShow" style="color:black">'+dayy+' '+monthh+' '+yearr+'</div>\
                            <div id="closePng" class="closeButton"></div>\
                        </div>\
                        <div style="clear:both;"></div>\
                        <div class="modalTableClass">\
                            <table cellspacing="1" cellpadding="0" class="modalTable" style="text-align:center;">\
                                <tr>\
                                <th style="color:black;">'+descriptionStr+'</th>\
                                <th style=" color:black;">תאריך</th>\
                                <th style=" color:black;">זמן התחלה</th>\
                                <th style=" color:black;">זמן סיום</th>\
                                <th style=" color:black;"></th>\
                                    \
                                </tr>\
                                '+(str != undefined ? searchEvent(str) :getEvents(s,e))+'\
                            </table>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>';
        $('body').append(html);
        $(".modalBack").fadeIn();
        $(".modalContainer").animate({
            height:'310px',
            width:'500px'
        },300, function(){
            $(".hider").fadeIn(400);
        });
        

        $(".modal .editEvent").die().live("click",function(){
            editShowModal($(this));
        });

        $("#closePng").die().live("click",function(){
            closeModal();
        })
    }


    function getEvents(s,e){
        s = s.replace("@", " ");
        e = e.replace("@", " ");
        var arr = s.split("-");
        var d = arr[0];
        var m = parseInt(arr[1])+1;
        var y = arr[2];

        var start1 = d+'-'+m+'-'+y;

        var arr2 = e.split("-");
        d = parseInt(arr2[0]);
        m = parseInt(arr2[1])+1;
        y = arr2[2];

        var end1 = d+'-'+m+'-'+y;

        var html = '';
        
        $.ajax({
            url: opts.url,
            type:'POST',
            async: false,
            dataType: 'json',
            data: "function=load&start="+start1+"&end="+end1,
            success: function(resp){
                for(var i = 0; i<resp.length; i++){
                    
                    
                    let color = resp[i].ack == "פגישה פנויה" ? "rgb(91, 253, 102)" : "rgb(253, 91, 91)";                        

                    html += '<tr>\
                    <td style="padding:6px;color:black;background-color:'+color+';">'+resp[i].ack+'</td>\
                    <td style="padding:6px;color:black;background-color:'+color+';">'+resp[i].date+'</td>\
                    <td style="padding:6px;color:black;background-color:'+color+';">'+resp[i].time+'</td>\
                    <td style="padding:6px;color:black;background-color:'+color+';">'+resp[i].etime+'</td>\
                    <td style="padding:6px;color:black;background-color:'+color+';">';

                    if(resp[i].ack == "פגישה פנויה")
                    {
                        html += '<form action="#" method="POST" onsubmit="return removemeeting(event);">\
                        <input type="hidden" id="mid" class="btn btn-primary" value="'+resp[i].id+'"></input>\
                        <button type="submit" id="submit" class="btn btn-primary">מחק</button></form>';
                    }

                    html+='</td><div style="clear:both" \></tr>';
                }
            }
        });
        
        return html;
    }

    function getStartEnd(str){
        var elf = '';
        var arr = str.split("_");
        var date = new Date(arr[2],arr[1],arr[0]);
        date.setDate(date.getDate()+1);elf = arr[0]+'-'+arr[1]+'-'+arr[2]+'@00:00'+'|'+date.getDate()+'-'+date.getMonth()+'-'+date.getFullYear()+'@00:00';        
        return elf;
    }
};