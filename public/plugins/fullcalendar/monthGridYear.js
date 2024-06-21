const MonthGridYear = {
    classNames: [ 'monthGridYear-view' ],
    duration: { years: 1 },
    buttonText: 'year',
    type: 'dayGrid',

    visibleRange: function(currentDate) {
        return { start: new Date(new Date().getFullYear(), 0, 1), end: new Date(new Date().getFullYear(), 11, 30) };
    },

    content: function(props) {
        var width = jQuery(".fc-view-harness.fc-view-harness-active").width();
        var height = jQuery(".fc-view-harness.fc-view-harness-active").height() - 28;
        var currentMonth = new Date().getMonth()
        let segs = FullCalendar.sliceEvents(props, true); // allDay=true
        var j = 0;
        let html =
            '<table class="fc-scrollgrid  fc-scrollgrid-liquid">' +
            '   <thead>' +
            '   <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">' +
            '       <td>' +
            '           <div class="fc-scroller-harness">' +
            '               <div class="fc-scroller" style="overflow: hidden;">' +
            '                   <table class="fc-col-header " style="width: ' + width + 'px">' +
            '                       <colgroup></colgroup>' +
            '                       <tbody>'+
            '                       <tr>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 0 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">January</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 1 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">February</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 2 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">March</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 3 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">April</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 4 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">May</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 5 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">June</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 6 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">July</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 7 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">August</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 8 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">September</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 9 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">October</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 10 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">November</a></div></th>' +
            '                           <th class="fc-col-header-cell ' + (currentMonth === 11 ? 'fc-daygrid-day fc-day-today': '') + '"><div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">December</a></div></th>' +
            '                       </tr>' +
            '                       </tbody>' +
            '                   </table>' +
            '               </div>' +
            '           </div>' +
            '       </td>' +
            '   </tr>' +
            '   </thead>' +
            '   <tbody>' +
            '       <tr class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">' +
            '           <td>' +
            '               <div class="fc-scroller-harness fc-scroller-harness-liquid">' +
            '                   <div class="fc-scroller fc-scroller-liquid-absolute" style="overflow: hidden auto;">' +
            '                       <div class="fc-daygrid-body fc-daygrid-body-unbalanced " style="width:' + width + 'px">' +
            '                           <table class="fc-scrollgrid-sync-table" style="width:' + width + 'px; height:' + height + 'px">' +
            '                               <colgroup></colgroup>' +
            '                               <tbody>' +
            '                               <tr>';
        for(var i = 0; i < 12; i++) {
            html += '' +
                '                                   <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other" data-date="2020-11-29">' +
                '                                       <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">' +
                '                                           <div class="fc-daygrid-day-top">' +
                '                                               <a class="fc-daygrid-day-number"></a> ' +
                '                                           </div> ' +
                '                                           <div class="fc-daygrid-day-events">';
            while(j < segs.length && segs[j].range.start.getMonth() === i) {
                html += '<div class="fc-daygrid-event-harness">' +
                    '       <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-start fc-event-end fc-event-past" href="' + segs[j].def.url + '" style="white-space:normal">' +
                    '           <div class="fc-event-main">' +
                    '               <div class="fc-event-main-frame">' +
                    '                   <div class="fc-event-title-container">' +
                    '                       <div class="fc-event-title fc-sticky">' + segs[j].def.title + '</div>' +
                    '                   </div>' +
                    '               </div>' +
                    '           </div>' +
                    '       </a>' +
                    '</div>';
                j++;
            }
            html += '</div>' +
                '                                           <div class="fc-daygrid-day-bg"></div> ' +
                '                                       </div>' +
                '                                   </td>';
        }
        html += '' +
            '                               </tr>' +
            '                       </tbody>' +
            '                   </table>' +
            '               </div>' +
            '           </div>' +
            '       </td>' +
            '   </tr>' +
            '   </tbody>' +
            '</table>';

        return { html: html }
    }
}