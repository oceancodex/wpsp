var Base=function(){},FlipClock;Base.extend=function(n,t){"use strict";var u=Base.prototype.extend,r,f,i;return Base._prototyping=!0,r=new this,u.call(r,n),r.base=function(){},delete Base._prototyping,f=r.constructor,i=r.constructor=function(){if(!Base._prototyping)if(this._constructing||this.constructor==i)this._constructing=!0,f.apply(this,arguments),delete this._constructing;else if(arguments[0]!==null)return(arguments[0].extend||u).call(arguments[0],r)},i.ancestor=this,i.extend=this.extend,i.forEach=this.forEach,i.implement=this.implement,i.prototype=r,i.toString=this.toString,i.valueOf=function(n){return n=="object"?i:f.valueOf()},u.call(i,t),typeof i.init=="function"&&i.init(),i};Base.prototype={extend:function(n,t){var r,f,u,i;if(arguments.length>1)r=this[n],r&&typeof t=="function"&&(!r.valueOf||r.valueOf()!=t.valueOf())&&/\bbase\b/.test(t)&&(f=t.valueOf(),t=function(){var t=this.base||Base.prototype.base,n;return this.base=r,n=f.apply(this,arguments),this.base=t,n},t.valueOf=function(n){return n=="object"?t:f},t.toString=Base.toString),this[n]=t;else if(n){u=Base.prototype.extend;Base._prototyping||typeof this=="function"||(u=this.extend||u);for(var e={toSource:null},o=["constructor","toString","valueOf"],s=Base._prototyping?0:1;i=o[s++];)n[i]!=e[i]&&u.call(this,i,n[i]);for(i in n)e[i]||u.call(this,i,n[i])}return this}};Base=Base.extend({constructor:function(){this.extend(arguments[0])}},{ancestor:Object,version:"1.1",forEach:function(n,t,i){for(var r in n)this.prototype[r]===undefined&&t.call(i,n[r],r,n)},implement:function(){for(var n=0;n<arguments.length;n++)typeof arguments[n]=="function"?arguments[n](this.prototype):this.prototype.extend(arguments[n]);return this},toString:function(){return String(this.valueOf())}}),function(n){"use strict";FlipClock=function(n,t,i){return t instanceof Object&&t instanceof Date==!1&&(i=t,t=0),new FlipClock.Factory(n,t,i)};FlipClock.Lang={};FlipClock.Base=Base.extend({buildDate:"2014-12-12",version:"0.7.7",constructor:function(t,i){typeof t!="object"&&(t={});typeof i!="object"&&(i={});this.setOptions(n.extend(!0,{},t,i))},callback:function(n){var i,t;if(typeof n=="function"){for(i=[],t=1;t<=arguments.length;t++)arguments[t]&&i.push(arguments[t]);n.apply(this,i)}},log:function(n){window.console&&console.log&&console.log(n)},getOption:function(n){return this[n]?this[n]:!1},getOptions:function(){return this},setOption:function(n,t){this[n]=t},setOptions:function(n){for(var t in n)typeof n[t]!="undefined"&&this.setOption(t,n[t])}})}(jQuery),function(n){"use strict";FlipClock.Face=FlipClock.Base.extend({autoStart:!0,dividers:[],factory:!1,lists:[],constructor:function(n,t){this.dividers=[];this.lists=[];this.base(t);this.factory=n},build:function(){this.autoStart&&this.start()},createDivider:function(t,i,r){var u,e,f;return typeof i!="boolean"&&i||(r=i,i=t),u=['<span class="'+this.factory.classes.dot+' top"><\/span>','<span class="'+this.factory.classes.dot+' bottom"><\/span>'].join(""),r&&(u=""),t=this.factory.localize(t),e=['<span class="'+this.factory.classes.divider+" "+(i?i:"").toLowerCase()+'">','<span class="'+this.factory.classes.label+'">'+(t?t:"")+"<\/span>",u,"<\/span>"],f=n(e.join("")),this.dividers.push(f),f},createList:function(n,t){typeof n=="object"&&(t=n,n=0);var i=new FlipClock.List(this.factory,n,t);return this.lists.push(i),i},reset:function(){this.factory.time=new FlipClock.Time(this.factory,this.factory.original?Math.round(this.factory.original):0,{minimumDigits:this.factory.minimumDigits});this.flip(this.factory.original,!1)},appendDigitToClock:function(n){n.$el.append(!1)},addDigit:function(n){var t=this.createList(n,{classes:{active:this.factory.classes.active,before:this.factory.classes.before,flip:this.factory.classes.flip}});this.appendDigitToClock(t)},start:function(){},stop:function(){},autoIncrement:function(){this.factory.countdown?this.decrement():this.increment()},increment:function(){this.factory.time.addSecond()},decrement:function(){this.factory.time.getTimeSeconds()==0?this.factory.stop():this.factory.time.subSecond()},flip:function(t,i){var r=this;n.each(t,function(n,t){var u=r.lists[n];u?(i||t==u.digit||u.play(),u.select(t)):r.addDigit(t)})}})}(jQuery),function(n){"use strict";FlipClock.Factory=FlipClock.Base.extend({animationRate:1e3,autoStart:!0,callbacks:{destroy:!1,create:!1,init:!1,interval:!1,start:!1,stop:!1,reset:!1},classes:{active:"flip-clock-active",before:"flip-clock-before",divider:"flip-clock-divider",dot:"flip-clock-dot",label:"flip-clock-label",flip:"flip",play:"play",wrapper:"flip-clock-wrapper"},clockFace:"HourlyCounter",countdown:!1,defaultClockFace:"HourlyCounter",defaultLanguage:"vietnamese",$el:!1,face:!0,lang:!1,language:"vietnamese",minimumDigits:0,original:!1,running:!1,time:!1,timer:!1,$wrapper:!1,constructor:function(t,i,r){r||(r={});this.lists=[];this.running=!1;this.base(r);this.$el=n(t).addClass(this.classes.wrapper);this.$wrapper=this.$el;this.original=i instanceof Date?i:i?Math.round(i):0;this.time=new FlipClock.Time(this,this.original,{minimumDigits:this.minimumDigits,animationRate:this.animationRate});this.timer=new FlipClock.Timer(this,r);this.loadLanguage(this.language);this.loadClockFace(this.clockFace,r);this.autoStart&&this.start()},loadClockFace:function(n,t){var i,r="Face",u=!1;return n=n.ucfirst()+r,this.face.stop&&(this.stop(),u=!0),this.$el.html(""),this.time.minimumDigits=this.minimumDigits,i=FlipClock[n]?new FlipClock[n](this,t):new FlipClock[this.defaultClockFace+r](this,t),i.build(),this.face=i,u&&this.start(),this.face},loadLanguage:function(n){var t;return t=FlipClock.Lang[n.ucfirst()]?FlipClock.Lang[n.ucfirst()]:FlipClock.Lang[n]?FlipClock.Lang[n]:FlipClock.Lang[this.defaultLanguage],this.lang=t},localize:function(n,t){var i=this.lang,r;return n?(r=n.toLowerCase(),typeof t=="object"&&(i=t),i&&i[r])?i[r]:n:null},start:function(n){var t=this;!t.running&&(!t.countdown||t.countdown&&t.time.time>0)?(t.face.start(t.time),t.timer.start(function(){t.flip();typeof n=="function"&&n()})):t.log("Trying to start timer when countdown already at 0")},stop:function(n){this.face.stop();this.timer.stop(n);for(var t in this.lists)this.lists.hasOwnProperty(t)&&this.lists[t].stop()},reset:function(n){this.timer.reset(n);this.face.reset()},setTime:function(n){this.time.time=n;this.flip(!0)},getTime:function(){return this.time},setCountdown:function(n){var t=this.running;this.countdown=n?!0:!1;t&&(this.stop(),this.start())},flip:function(n){this.face.flip(!1,n)}})}(jQuery),function(n){"use strict";FlipClock.List=FlipClock.Base.extend({digit:0,classes:{active:"flip-clock-active",before:"flip-clock-before",flip:"flip"},factory:!1,$el:!1,$obj:!1,items:[],lastDigit:0,constructor:function(n,t){this.factory=n;this.digit=t;this.lastDigit=t;this.$el=this.createList();this.$obj=this.$el;t>0&&this.select(t);this.factory.$el.append(this.$el)},select:function(n){if(typeof n=="undefined"?n=this.digit:this.digit=n,this.digit!=this.lastDigit){var t=this.$el.find("."+this.classes.before).removeClass(this.classes.before);this.$el.find("."+this.classes.active).removeClass(this.classes.active).addClass(this.classes.before);this.appendListItem(this.classes.active,this.digit);t.remove();this.lastDigit=this.digit}},play:function(){this.$el.addClass(this.factory.classes.play)},stop:function(){var n=this;setTimeout(function(){n.$el.removeClass(n.factory.classes.play)},this.factory.timer.interval)},createListItem:function(n,t){return['<li class="'+(n?n:"")+'">','<a href="#">','<div class="up">','<div class="shadow"><\/div>','<div class="inn">'+(t?t:"")+"<\/div>","<\/div>",'<div class="down">','<div class="shadow"><\/div>','<div class="inn">'+(t?t:"")+"<\/div>","<\/div>","<\/a>","<\/li>"].join("")},appendListItem:function(n,t){var i=this.createListItem(n,t);this.$el.append(i)},createList:function(){var t=this.getPrevDigit()?this.getPrevDigit():this.digit;return n(['<ul class="'+this.classes.flip+" "+(this.factory.running?this.factory.classes.play:"")+'">',this.createListItem(this.classes.before,t),this.createListItem(this.classes.active,this.digit),"<\/ul>"].join(""))},getNextDigit:function(){return this.digit==9?0:this.digit+1},getPrevDigit:function(){return this.digit==0?9:this.digit-1}})}(jQuery),function(n){"use strict";String.prototype.ucfirst=function(){return this.substr(0,1).toUpperCase()+this.substr(1)};n.fn.FlipClock=function(t,i){return new FlipClock(n(this),t,i)};n.fn.flipClock=function(t,i){return n.fn.FlipClock(t,i)}}(jQuery),function(n){"use strict";FlipClock.Time=FlipClock.Base.extend({time:0,factory:!1,minimumDigits:0,constructor:function(n,t,i){typeof i!="object"&&(i={});i.minimumDigits||(i.minimumDigits=n.minimumDigits);this.base(i);this.factory=n;t&&(this.time=t)},convertDigitsToArray:function(n){var i=[],t;for(n=n.toString(),t=0;t<n.length;t++)n[t].match(/^\d*$/g)&&i.push(n[t]);return i},digit:function(n){var t=this.toString(),i=t.length;return t[i-n]?t[i-n]:!1},digitize:function(t){var i=[],r;if(n.each(t,function(n,t){t=t.toString();t.length==1&&(t="0"+t);for(var r=0;r<t.length;r++)i.push(t.charAt(r))}),i.length>this.minimumDigits&&(this.minimumDigits=i.length),this.minimumDigits>i.length)for(r=i.length;r<this.minimumDigits;r++)i.unshift("0");return i},getDateObject:function(){return this.time instanceof Date?this.time:new Date((new Date).getTime()+this.getTimeSeconds()*1e3)},getDayCounter:function(n){var t=[this.getDays(),this.getHours(!0),this.getMinutes(!0)];return n&&t.push(this.getSeconds(!0)),this.digitize(t)},getDays:function(n){var t=this.getTimeSeconds()/86400;return n&&(t=t%7),Math.floor(t)},getHourCounter:function(){return this.digitize([this.getHours(),this.getMinutes(!0),this.getSeconds(!0)])},getHourly:function(){return this.getHourCounter()},getHours:function(n){var t=this.getTimeSeconds()/3600;return n&&(t=t%24),Math.floor(t)},getMilitaryTime:function(n,t){typeof t=="undefined"&&(t=!0);n||(n=this.getDateObject());var i=[n.getHours(),n.getMinutes()];return t===!0&&i.push(n.getSeconds()),this.digitize(i)},getMinutes:function(n){var t=this.getTimeSeconds()/60;return n&&(t=t%60),Math.floor(t)},getMinuteCounter:function(){return this.digitize([this.getMinutes(),this.getSeconds(!0)])},getTimeSeconds:function(n){return n||(n=new Date),this.time instanceof Date?this.factory.countdown?Math.max(this.time.getTime()/1e3-n.getTime()/1e3,0):n.getTime()/1e3-this.time.getTime()/1e3:this.time},getTime:function(n,t){typeof t=="undefined"&&(t=!0);n||(n=this.getDateObject());console.log(n);var i=n.getHours(),u=i>12?"PM":"AM",r=[i>12?i-12:i===0?12:i,n.getMinutes()];return t===!0&&r.push(n.getSeconds()),this.digitize(r)},getSeconds:function(n){var t=this.getTimeSeconds();return n&&(t=t==60?0:t%60),Math.ceil(t)},getWeeks:function(n){var t=this.getTimeSeconds()/604800;return n&&(t=t%52),Math.floor(t)},removeLeadingZeros:function(t,i){var r=0,u=[];return(n.each(i,function(n){n<t?r+=parseInt(i[n],10):u.push(i[n])}),r===0)?u:i},addSeconds:function(n){this.time instanceof Date?this.time.setSeconds(this.time.getSeconds()+n):this.time+=n},addSecond:function(){this.addSeconds(1)},subSeconds:function(n){this.time instanceof Date?this.time.setSeconds(this.time.getSeconds()-n):this.time-=n},subSecond:function(){this.subSeconds(1)},toString:function(){return this.getTimeSeconds().toString()}})}(jQuery),function(){"use strict";FlipClock.Timer=FlipClock.Base.extend({callbacks:{destroy:!1,create:!1,init:!1,interval:!1,start:!1,stop:!1,reset:!1},count:0,factory:!1,interval:1e3,animationRate:1e3,constructor:function(n,t){this.base(t);this.factory=n;this.callback(this.callbacks.init);this.callback(this.callbacks.create)},getElapsed:function(){return this.count*this.interval},getElapsedTime:function(){return new Date(this.time+this.getElapsed())},reset:function(n){clearInterval(this.timer);this.count=0;this._setInterval(n);this.callback(this.callbacks.reset)},start:function(n){this.factory.running=!0;this._createTimer(n);this.callback(this.callbacks.start)},stop:function(n){this.factory.running=!1;this._clearInterval(n);this.callback(this.callbacks.stop);this.callback(n)},_clearInterval:function(){clearInterval(this.timer)},_createTimer:function(n){this._setInterval(n)},_destroyTimer:function(n){this._clearInterval();this.timer=!1;this.callback(n);this.callback(this.callbacks.destroy)},_interval:function(n){this.callback(this.callbacks.interval);this.callback(n);this.count++},_setInterval:function(n){var t=this;t._interval(n);t.timer=setInterval(function(){t._interval(n)},this.interval)}})}(jQuery),function(n){FlipClock.TwentyFourHourClockFace=FlipClock.Face.extend({constructor:function(n,t){this.base(n,t)},build:function(t){var i=this,r=this.factory.$el.find("ul"),t;this.factory.time.time||(this.factory.original=new Date,this.factory.time=new FlipClock.Time(this.factory,this.factory.original));t=t?t:this.factory.time.getMilitaryTime(!1,this.showSeconds);t.length>r.length&&n.each(t,function(n,t){i.createList(t)});this.createDivider();this.createDivider();n(this.dividers[0]).insertBefore(this.lists[this.lists.length-2].$el);n(this.dividers[1]).insertBefore(this.lists[this.lists.length-4].$el);this.base()},flip:function(n,t){this.autoIncrement();n=n?n:this.factory.time.getMilitaryTime(!1,this.showSeconds);this.base(n,t)}})}(jQuery),function(n){FlipClock.CounterFace=FlipClock.Face.extend({shouldAutoIncrement:!1,constructor:function(n,t){typeof t!="object"&&(t={});n.autoStart=t.autoStart?!0:!1;t.autoStart&&(this.shouldAutoIncrement=!0);n.increment=function(){n.countdown=!1;n.setTime(n.getTime().getTimeSeconds()+1)};n.decrement=function(){n.countdown=!0;var t=n.getTime().getTimeSeconds();t>0&&n.setTime(t-1)};n.setValue=function(t){n.setTime(t)};n.setCounter=function(t){n.setTime(t)};this.base(n,t)},build:function(){var i=this,r=this.factory.$el.find("ul"),t=this.factory.getTime().digitize([this.factory.getTime().time]);t.length>r.length&&n.each(t,function(n,t){var r=i.createList(t);r.select(t)});n.each(this.lists,function(n,t){t.play()});this.base()},flip:function(n,t){this.shouldAutoIncrement&&this.autoIncrement();n||(n=this.factory.getTime().digitize([this.factory.getTime().time]));this.base(n,t)},reset:function(){this.factory.time=new FlipClock.Time(this.factory,this.factory.original?Math.round(this.factory.original):0);this.flip()}})}(jQuery),function(n){FlipClock.DailyCounterFace=FlipClock.Face.extend({showSeconds:!0,constructor:function(n,t){this.base(n,t)},build:function(t){var r=this,u=this.factory.$el.find("ul"),i=0;t=t?t:this.factory.time.getDayCounter(this.showSeconds);t.length>u.length&&n.each(t,function(n,t){r.createList(t)});this.showSeconds?n(this.createDivider("Seconds")).insertBefore(this.lists[this.lists.length-2].$el):i=2;n(this.createDivider("Minutes")).insertBefore(this.lists[this.lists.length-4+i].$el);n(this.createDivider("Hours")).insertBefore(this.lists[this.lists.length-6+i].$el);n(this.createDivider("Days",!0)).insertBefore(this.lists[0].$el);this.base()},flip:function(n,t){n||(n=this.factory.time.getDayCounter(this.showSeconds));this.autoIncrement();this.base(n,t)}})}(jQuery),function(n){FlipClock.HourlyCounterFace=FlipClock.Face.extend({constructor:function(n,t){this.base(n,t)},build:function(t,i){var r=this,u=this.factory.$el.find("ul");i=i?i:this.factory.time.getHourCounter();i.length>u.length&&n.each(i,function(n,t){r.createList(t)});n(this.createDivider("Seconds")).insertBefore(this.lists[this.lists.length-2].$el);n(this.createDivider("Minutes")).insertBefore(this.lists[this.lists.length-4].$el);t||n(this.createDivider("Hours",!0)).insertBefore(this.lists[0].$el);this.base()},flip:function(n,t){n||(n=this.factory.time.getHourCounter());this.autoIncrement();this.base(n,t)},appendDigitToClock:function(n){this.base(n);this.dividers[0].insertAfter(this.dividers[0].next())}})}(jQuery),function(){FlipClock.MinuteCounterFace=FlipClock.HourlyCounterFace.extend({clearExcessDigits:!1,constructor:function(n,t){this.base(n,t)},build:function(){this.base(!0,this.factory.time.getMinuteCounter())},flip:function(n,t){n||(n=this.factory.time.getMinuteCounter());this.base(n,t)}})}(jQuery),function(n){FlipClock.TwelveHourClockFace=FlipClock.TwentyFourHourClockFace.extend({meridium:!1,meridiumText:"AM",build:function(){var i=this,t=this.factory.time.getTime(!1,this.showSeconds);this.base(t);this.meridiumText=this.getMeridium();this.meridium=n(['<ul class="flip-clock-meridium">',"<li>",'<a href="#">'+this.meridiumText+"<\/a>","<\/li>","<\/ul>"].join(""));this.meridium.insertAfter(this.lists[this.lists.length-1].$el)},flip:function(n,t){this.meridiumText!=this.getMeridium()&&(this.meridiumText=this.getMeridium(),this.meridium.find("a").html(this.meridiumText));this.base(this.factory.time.getTime(!1,this.showSeconds),t)},getMeridium:function(){return(new Date).getHours()>=12?"PM":"AM"},isPM:function(){return this.getMeridium()=="PM"?!0:!1},isAM:function(){return this.getMeridium()=="AM"?!0:!1}})}(jQuery),function(){FlipClock.Lang.Arabic={years:"سنوات",months:"شهور",days:"أيام",hours:"ساعات",minutes:"دقائق",seconds:"ثواني"};FlipClock.Lang.ar=FlipClock.Lang.Arabic;FlipClock.Lang["ar-ar"]=FlipClock.Lang.Arabic;FlipClock.Lang.arabic=FlipClock.Lang.Arabic}(jQuery),function(){FlipClock.Lang.Danish={years:"År",months:"Måneder",days:"Dage",hours:"Timer",minutes:"Minutter",seconds:"Sekunder"};FlipClock.Lang.da=FlipClock.Lang.Danish;FlipClock.Lang["da-dk"]=FlipClock.Lang.Danish;FlipClock.Lang.danish=FlipClock.Lang.Danish}(jQuery),function(){FlipClock.Lang.German={years:"Jahre",months:"Monate",days:"Tage",hours:"Stunden",minutes:"Minuten",seconds:"Sekunden"};FlipClock.Lang.de=FlipClock.Lang.German;FlipClock.Lang["de-de"]=FlipClock.Lang.German;FlipClock.Lang.german=FlipClock.Lang.German}(jQuery),function(){FlipClock.Lang.English={years:"Years",months:"Months",days:"Days",hours:"Hours",minutes:"Minutes",seconds:"Seconds"};FlipClock.Lang.en=FlipClock.Lang.English;FlipClock.Lang["en-us"]=FlipClock.Lang.English;FlipClock.Lang.english=FlipClock.Lang.English}(jQuery),function(){FlipClock.Lang.Spanish={years:"Años",months:"Meses",days:"Días",hours:"Horas",minutes:"Minutos",seconds:"Segundos"};FlipClock.Lang.es=FlipClock.Lang.Spanish;FlipClock.Lang["es-es"]=FlipClock.Lang.Spanish;FlipClock.Lang.spanish=FlipClock.Lang.Spanish}(jQuery),function(){FlipClock.Lang.Finnish={years:"Vuotta",months:"Kuukautta",days:"Päivää",hours:"Tuntia",minutes:"Minuuttia",seconds:"Sekuntia"};FlipClock.Lang.fi=FlipClock.Lang.Finnish;FlipClock.Lang["fi-fi"]=FlipClock.Lang.Finnish;FlipClock.Lang.finnish=FlipClock.Lang.Finnish}(jQuery),function(){FlipClock.Lang.French={years:"Ans",months:"Mois",days:"Jours",hours:"Heures",minutes:"Minutes",seconds:"Secondes"};FlipClock.Lang.fr=FlipClock.Lang.French;FlipClock.Lang["fr-ca"]=FlipClock.Lang.French;FlipClock.Lang.french=FlipClock.Lang.French}(jQuery),function(){FlipClock.Lang.Italian={years:"Anni",months:"Mesi",days:"Giorni",hours:"Ore",minutes:"Minuti",seconds:"Secondi"};FlipClock.Lang.it=FlipClock.Lang.Italian;FlipClock.Lang["it-it"]=FlipClock.Lang.Italian;FlipClock.Lang.italian=FlipClock.Lang.Italian}(jQuery),function(){FlipClock.Lang.Latvian={years:"Gadi",months:"Mēneši",days:"Dienas",hours:"Stundas",minutes:"Minūtes",seconds:"Sekundes"};FlipClock.Lang.lv=FlipClock.Lang.Latvian;FlipClock.Lang["lv-lv"]=FlipClock.Lang.Latvian;FlipClock.Lang.latvian=FlipClock.Lang.Latvian}(jQuery),function(){FlipClock.Lang.Dutch={years:"Jaren",months:"Maanden",days:"Dagen",hours:"Uren",minutes:"Minuten",seconds:"Seconden"};FlipClock.Lang.nl=FlipClock.Lang.Dutch;FlipClock.Lang["nl-be"]=FlipClock.Lang.Dutch;FlipClock.Lang.dutch=FlipClock.Lang.Dutch}(jQuery),function(){FlipClock.Lang.Norwegian={years:"År",months:"Måneder",days:"Dager",hours:"Timer",minutes:"Minutter",seconds:"Sekunder"};FlipClock.Lang.no=FlipClock.Lang.Norwegian;FlipClock.Lang.nb=FlipClock.Lang.Norwegian;FlipClock.Lang["no-nb"]=FlipClock.Lang.Norwegian;FlipClock.Lang.norwegian=FlipClock.Lang.Norwegian}(jQuery),function(){FlipClock.Lang.Portuguese={years:"Anos",months:"Meses",days:"Dias",hours:"Horas",minutes:"Minutos",seconds:"Segundos"};FlipClock.Lang.pt=FlipClock.Lang.Portuguese;FlipClock.Lang["pt-br"]=FlipClock.Lang.Portuguese;FlipClock.Lang.portuguese=FlipClock.Lang.Portuguese}(jQuery),function(){FlipClock.Lang.Russian={years:"лет",months:"месяцев",days:"дней",hours:"часов",minutes:"минут",seconds:"секунд"};FlipClock.Lang.ru=FlipClock.Lang.Russian;FlipClock.Lang["ru-ru"]=FlipClock.Lang.Russian;FlipClock.Lang.russian=FlipClock.Lang.Russian}(jQuery),function(){FlipClock.Lang.Swedish={years:"År",months:"Månader",days:"Dagar",hours:"Timmar",minutes:"Minuter",seconds:"Sekunder"};FlipClock.Lang.sv=FlipClock.Lang.Swedish;FlipClock.Lang["sv-se"]=FlipClock.Lang.Swedish;FlipClock.Lang.swedish=FlipClock.Lang.Swedish}(jQuery),function(){FlipClock.Lang.Chinese={years:"年",months:"月",days:"日",hours:"时",minutes:"分",seconds:"秒"};FlipClock.Lang.zh=FlipClock.Lang.Chinese;FlipClock.Lang["zh-cn"]=FlipClock.Lang.Chinese;FlipClock.Lang.chinese=FlipClock.Lang.Chinese}(jQuery),function(){FlipClock.Lang.Vietnamese={years:"Năm",months:"Tháng",days:"Ngày",hours:"Giờ",minutes:"Phút",seconds:"Giây"};FlipClock.Lang.vietnamese=FlipClock.Lang.Vietnamese}(jQuery)