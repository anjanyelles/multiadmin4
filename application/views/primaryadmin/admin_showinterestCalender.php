<html lang="en">

<head>
    <meta charset="utf-8">
    <title> Jquery Calendar Example </title>
    <meta name="description" content="Calendar">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<style>
body {
    height: 100%;
    width: 100%;
    margin: 0;
    background: #005C97;
    background: -webkit-linear-gradient(left, #363795, #005C97);
    background: -moz-linear-gradient(left, #363795, #005C97);
    background: -o-linear-gradient(left, #363795, #005C97);
    background: linear-gradient(to right, #363795, #005C97);
    font-family: Helvetica;
}

.content {
    overflow: none;
    max-width: 790px;
    padding: 0px 0;
    height: 500px;
    position: relative;
    margin: 20px auto;
    background: #52A0FD;
    background: -moz-linear-gradient(right, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    background: -webkit-linear-gradient(right, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    background: linear-gradient(to left, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    border-radius: 3px;
    box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    -moz-box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    -webkit-box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
}


.events-container {
    /*   overflow-y: scroll;  */
    height: 100%;
    float: right;
    margin: 0px auto;
    font: 13px Helvetica, Arial, sans-serif;
    display: inline-block;
    padding: 0 10px;
    border-bottom-right-radius: 3px;
    border-top-right-radius: 3px;
}

.events-container:after {
    clear: both;
}

.event-card {
    padding: 20px 0;
    width: 350px;
    margin: 20px auto;
    display: block;
    background: #fff;
    border-left: 10px solid #52A0FD;
    border-radius: 3px;
    box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    -moz-box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    -webkit-box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
}

.event-count,
.event-name,
.event-cancelled {
    display: inline;
    padding: 0 10px;
    font-size: 1rem;
}

.event-count {
    color: #52A0FD;
    text-align: right;
}

.event-name {
    padding-right: 0;
    text-align: left;
}

.event-cancelled {
    color: #FF1744;
    text-align: right;
}

.calendar-container {
    float: left;
    position: relative;
    margin: 0px auto;
    height: 100%;
    background: #fff;
    font: 13px Helvetica, Arial, san-serif;
    display: inline-block;
    border-bottom-left-radius: 3px;
    border-top-left-radius: 3px;
}

.calendar-container:after {
    clear: both;
}

.calendar {
    display: table;
}

.year-header {
    background: #52A0FD;
    background: -moz-linear-gradient(left, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    background: -webkit-linear-gradient(left, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    background: linear-gradient(to right, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    font-family: Helvetica;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    -moz-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    height: 40px;
    text-align: center;
    position: relative;
    color: #fff;
    border-top-left-radius: 3px;
}

.year-header span {
    display: inline-block;
    font-size: 20px;
    line-height: 40px;
}

.left-button,
.right-button {
    cursor: pointer;
    width: 28px;
    text-align: center;
    position: absolute;
}

.left-button {
    left: 0;
    -webkit-border-top-left-radius: 5px;
    -moz-border-radius-topleft: 5px;
    border-top-left-radius: 5px;
}

.right-button {
    right: 0;
    top: 0;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    border-top-right-radius: 5px;
}

.left-button:hover {
    background: #3FADFF;
}

.right-button:hover {
    background: #00C1FF;
}

.button {
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    outline: none;
    font-size: 1rem;
    border-radius: 25px;
    padding: 0.65rem 1.9rem;
    transition: .2s ease all;
    color: white;
    border: none;
    box-shadow: -1px 10px 20px #9BC6FD;
    background: #52A0FD;
    background: -moz-linear-gradient(left, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    background: -webkit-linear-gradient(left, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    background: linear-gradient(to right, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
}

#cancel-button {
    box-shadow: -1px 10px 20px #FF7DAE;
    background: #FF1744;
    background: -moz-linear-gradient(left, #FF1744 0%, #FF5D95 80%, #FF5D95 100%);
    background: -webkit-linear-gradient(left, #FF1744 0%, #FF5D95 80%, #FF5D95 100%);
    background: linear-gradient(to right, #FF1744 0%, #FF5D95 80%, #FF5D95 100%);
}

#add-button {
    display: block;
    position: absolute;
    right: 20px;
    bottom: 20px;
}

#add-button:hover,
#ok-button:hover,
#cancel-button:hover {
    transform: scale(1.03);
}

#add-button:active,
#ok-button:active,
#cancel-button:active {
    transform: translateY(3px) scale(.97);
}

.days-table {
    border-collapse: separate;
    text-align: center;
}

.dates-table {
    border-collapse: separate;
    text-align: center;
}

.months-table {
    border-collapse: separate;
    text-align: center;
}

.day {
    height: 26px;
    width: 26px;
    padding: 0 10px;
    line-height: 26px;
    border: 2px solid transparent;
    text-transform: uppercase;
    font-size: 90%;
    color: #9e9e9e;
}

.month {
    cursor: default;
    height: 26px;
    width: 26px;
    padding: 0 2px;
    padding-top: 10px;
    line-height: 26px;
    text-transform: uppercase;
    font-size: 11px;
    color: #9e9e9e;
    transition: all 250ms;
}

.active-month {
    font-weight: bold;
    font-size: 14px;
    color: #FF1744;
    text-shadow: 0 1px 4px RGBA(255, 50, 120, .8);
}

.month:hover {
    color: #FF1744;
    text-shadow: 0 1px 4px RGBA(255, 50, 120, .8);
}

.table-date {
    cursor: default;
    color: #2b2b2b;
    height: 26px;
    width: 26px;
    font-size: 15px;
    padding: 10px;
    line-height: 26px;
    text-align: center;
    border-radius: 50%;
    border: 2px solid transparent;
    transition: all 250ms;
}

.table-date:not(.nil):hover {
    border-color: #FF1744;
    box-shadow: 0 2px 6px RGBA(255, 50, 120, .9);
}

/*.event-date {  
    border-color:#52A0FD;  
    box-shadow: 0 2px 8px RGBA(130, 180, 255, .9);  
}  */
.active-date {
    background: #FF1744;
    box-shadow: 0 2px 8px RGBA(255, 50, 120, .9);
    color: #fff;
}

.event-date.active-date {
    background: #52A0FD;
    box-shadow: 0 2px 8px RGBA(130, 180, 255, .9);
}

.dialog {
    z-index: 5;
    background: #fff;
    position: absolute;
    width: 415px;
    height: 500px;
    left: 387px;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
    display: none;
    border-left: 1px #aaa solid;
}

.dialog-header {
    margin: 20px;
    color: #333;
    text-align: center;
}

.form-container {
    margin-top: 25%;
}

.form-label {
    color: #333;
}

.input {
    border: none;
    background: none;
    border-bottom: 1px #aaa solid;
    display: block;
    margin-bottom: 50px;
    width: 200px;
    height: 20px;
    text-align: center;
    transition: border-color 250ms;
}

.input:focus {
    outline: none;
    border-color: #00C9FB;
}

.error-input {
    border-color: #FF1744;
}

@media only screen and (max-width: 780px) {
    .content {
        overflow: visible;
        position: relative;
        max-width: 100%;
        width: 370px;
        height: 100%;
        background: #52A0FD;
        background: -moz-linear-gradient(left, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
        background: linear-gradient(to right, #52A0FD 0%, #00C9FB 80%, #00C9FB 100%);
    }

    .dialog {
        width: 370px;
        height: 450px;
        border-radius: 3px;
        top: 0;
        left: 0;
    }

    .events-container {
        float: none;
        overflow: visible;
        margin: 0 auto;
        padding: 0;
        display: block;
        left: 0;
        border-radius: 3px;
    }

    .calendar-container {
        float: none;
        padding: 0;
        margin: 0 auto;
        margin-right: 0;
        display: block;
        left: 0;
        border-radius: 3px;
        box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        -moz-box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
        -webkit-box-shadow: 3px 8px 16px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
    }
}

@media only screen and (max-width: 400px) {

    .content,
    .events-container,
    .year-header,
    .calendar-container {
        width: 320px;
    }

    .dialog {
        width: 320px;
    }

    .months-table {
        display: block;
        margin: 0 auto;
        width: 320px;
    }

    .event-card {
        width: 300px;
    }

    .day {
        padding: 0 7px;
    }

    .month {
        display: inline-block;
        padding: 10px 10px;
        font-size: .8rem;
    }

    .table-date {
        width: 20px;
        height: 20px;
        line-height: 20px;
    }

    .event-name,
    .event-count {
        font-size: .8rem;
    }

    event-cancelled {
        font-size: .8rem;
    }

    .add-button {
        bottom: 10px;
        right: 10px;
        padding: 0.5rem 1.5rem;
    }
}
</style>

<body>
    <div class="content">
        <div class="calendar-container">
            <div class="calendar">
                <div class="year-header">
                    <span class="left-button" id="prev"> ? </span>
                    <span class="year" id="label"> </span>
                    <span class="right-button" id="next"> ? </span>
                </div>
                <table class="months-table">
                    <tbody>
                        <tr class="months-row">
                            <td class="month"> Jan </td>
                            <td class="month"> Feb </td>
                            <td class="month"> Mar </td>
                            <td class="month"> Apr </td>
                            <td class="month"> May </td>
                            <td class="month"> June </td>
                            <td class="month"> July </td>
                            <td class="month"> Aug </td>
                            <td class="month"> Sep </td>
                            <td class="month"> Oct </td>
                            <td class="month"> Nov </td>
                            <td class="month"> Dec </td>
                        </tr>
                    </tbody>
                </table>
                <table class="days-table">
                    <td class="day"> Sun </td>
                    <td class="day"> Mon </td>
                    <td class="day"> Tue </td>
                    <td class="day"> Wed </td>
                    <td class="day"> Thu </td>
                    <td class="day"> Fri </td>
                    <td class="day"> Sat </td>
                </table>
                <div class="frame">
                    <table class="dates-table">
                        <tbody class="tbody">
                        </tbody>
                    </table>
                </div>
                <!--   <button class = "button" id = "add-button"> Add Event </button>   -->
            </div>
        </div>
        <div class="events-container">
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        var date = new Date();
        var today = date.getDate();
        $(".right-button").click({
            date: date
        }, next_year);
        $(".left-button").click({
            date: date
        }, prev_year);
        $(".month").click({
            date: date
        }, month_click);
        $("#add-button").click({
            date: date
        }, new_event);
        $(".months-row").children().eq(date.getMonth()).addClass("active-month");
        init_calendar(date);
        var events = check_events(today, date.getMonth() + 1, date.getFullYear());
        show_events(events, months[date.getMonth()], today);
    });

    function init_calendar(date) {
        $(".tbody").empty();
        $(".events-container").empty();
        var calendar_days = $(".tbody");
        var month = date.getMonth();
        var year = date.getFullYear();
        var day_count = days_in_month(month, year);
        var row = $("<tr class='table-row'></tr>");
        var today = date.getDate();
        date.setDate(1);
        var first_day = date.getDay();
        for (var i = 0; i < 35 + first_day; i++) {
            var day = i - first_day + 1;
            if (i % 7 === 0) {
                calendar_days.append(row);
                row = $("<tr class='table-row'></tr>");
            }

            if (i < first_day || day > day_count) {
                var curr_date = $("<td class='table-date nil'>" + "</td>");
                row.append(curr_date);
            } else {
                var curr_date = $("<td class='table-date'>" + day + "</td>");
                var events = check_events(day, month + 1, year);

                if (today === day && $(".active-date").length === 0) {
                    curr_date.addClass("active-date");
                    show_events(events, months[month], day);
                }
                if (events.length !== 0) {
                    curr_date.addClass("event-date");
                }
                curr_date.click({
                    events: events,
                    month: months[month],
                    day: day
                }, date_click);
                row.append(curr_date);
            }
        }
        calendar_days.append(row);
        $(".year").text(year);
    }

    function days_in_month(month, year) {
        var monthStart = new Date(year, month, 1);
        var monthEnd = new Date(year, month + 1, 1);
        return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);
    }

    function date_click(event) {
        $(".events-container").show(250);
        $("#dialog").hide(250);
        $(".active-date").removeClass("active-date");
        $(this).addClass("active-date");
        show_events(event.data.events, event.data.month, event.data.day);
    };

    function month_click(event) {
        $(".events-container").show(250);
        $("#dialog").hide(250);
        var date = event.data.date;
        $(".active-month").removeClass("active-month");
        $(this).addClass("active-month");
        var new_month = $(".month").index(this);
        date.setMonth(new_month);
        init_calendar(date);
    }

    function next_year(event) {
        $("#dialog").hide(250);
        var date = event.data.date;
        var new_year = date.getFullYear() + 1;
        $("year").html(new_year);
        date.setFullYear(new_year);

        init_calendar(date);
    }

    function prev_year(event) {
        $("#dialog").hide(250);
        var date = event.data.date;
        var new_year = date.getFullYear() - 1;
        $("year").html(new_year);
        date.setFullYear(new_year);
        init_calendar(date);
    }

    function new_event(event) {
        if ($(".active-date").length === 0)
            return;
        $("input").click(function() {
            $(this).removeClass("error-input");
        })
        $("#dialog input[type=text]").val('');
        $("#dialog input[type=number]").val('');
        $(".events-container").hide(250);
        $("#dialog").show(250);
        $("#cancel-button").click(function() {
            $("#name").removeClass("error-input");
            $("#count").removeClass("error-input");
            $("#dialog").hide(250);
            $(".events-container").show(250);
        });
        $("#ok-button").unbind().click({
            date: event.data.date
        }, function() {
            var date = event.data.date;
            var name = $("#name").val().trim();
            var count = parseInt($("#count").val().trim());
            var day = parseInt($(".active-date").html());
            if (name.length === 0) {
                $("#name").addClass("error-input");
            } else if (isNaN(count)) {
                $("#count").addClass("error-input");
            } else {
                $("#dialog").hide(250);
                console.log("new event");
                new_event_json(name, count, date, day);
                date.setDate(day);
                init_calendar(date);
            }
        });
    }

    function new_event_json(name, count, date, day) {
        var event = {
            "occasion": name,
            "invited_count": count,
            "year": date.getFullYear(),
            "month": date.getMonth() + 1,
            "day": day
        };
        event_data["events"].push(event);
    }

    function show_events(events, month, day) {
        $(".events-container").empty();
        $(".events-container").show(250);

        if (events.length === 0) {
            var event_card = $("<div class='event-card'> </div>");
            var event_name = $("<div class='event-name'>There are no events planned for " + month + " " + day +
                ".</div>");
            $(event_card).css({
                "border-left": "10px solid #FF1744"
            });
            $(event_card).append(event_name);
            $(".events-container").append(event_card);
        } else {
            for (var i = 0; i < events.length; i++) {
                var event_card = $("<div class='event-card'></div>");
                var event_name = $("<div class='event-name'>" + events[i]["paymentDate"] + ":</div>");
                var event_count = $("<div class='event-count'>" + events[i]["paymentMonth"] +
                    "   PAYMENT AMOUNT </div>");
                if (events[i]["cancelled"] === true) {
                    $(event_card).css({
                        "border-left": "10px solid #FF1744"
                    });
                    event_count = $("<div class='event-cancelled'>Cancelled</div>");
                }
                $(event_card).append(event_name).append(event_count);
                $(".events-container").append(event_card);
            }
        }
    }

    function check_events(day, month, year) {

        var events = [];
        for (var i = 0; i < event_data["events"].length; i++) {
            var event = event_data["events"][i];
            var convertdate = new Date(event['paymentDate']);
            if (convertdate.getDate() == day &&
                convertdate.getMonth() + 1 == month &&
                convertdate.getFullYear() == year) {

                events.push(event);



            }
        }

        return events;
    }

    // var obj;


    //     var eventsplus=[];  

    // axios.get('https://meta.oxyloans.com/v1/user/dealLevelInterestPaymentsInfo/August/2022',

    //             {headers:{
    //            accessToken:"eyJ1c2VySWQiOiIxIiwiaWF0IjoxNjU5NjE3NjYzNTUzLCJ0dGwiOjcyMDAsInZlcnNpb24iOiJ2MSIsImdyYW50VHlwZSI6IlBXRCIsImFsZ29yaXRobSI6IlJTQSJ9.g51HkOcgLPkqtZy6C7qoFNhD4GPJ/rzvilr0Wo4EuLqiTEyjjSr41Qsb14HOTTS3FFcKRySPY2Y8Kf2zj14MNLubVfd2gCrXVcQDiOYLIi2pXIIjh4oI2B67EwXmaRMhVUeqIGGKJZY1LfgApg5+DATceR/V9W5VBsoC0Uz5hgXMcS8a+QQ73aNaCIUcGi5CFiYOqVi4sxdBbD5coHSqxipBDC9XsPWezhNyCh70O1XKUXlSr2PCr+tOw/Z4SAPmvIHRtoG7KDFQ2K1yVe8vdfGixFBCi5IKoy1mrFT3VgaWW4jqbU9l/vvxOo9D8gIqm5zmZWeIbPAcwVG5SDKtbA=="
    //              }})
    //          .then(function(response){
    //          obj = response.data;

    //           eventsplus.push(obj);


    //        })
    //      .catch(function(error){
    //             console.log(error);
    //      });

    // console.log(eventsplus[[0]]);

    //  alert([eventsplus[0[0[0]]]]);


    var event_data = {
        "events": [

            {
                "paymentDate": "2022-08-04",
                "paymentMonth": 10000
            },
            {
                "paymentDate": "2022-08-05",
                "paymentMonth": 15964
            },
            {
                "paymentDate": "2022-08-06",
                "paymentMonth": 419969568
            },
            {
                "paymentDate": "2022-08-07",
                "paymentMonth": 95959
            },
            {
                "paymentDate": "2022-08-08",
                "paymentMonth": 69655
            },
            {
                "paymentDate": "2022-08-09",
                "paymentMonth": 89554
            },
            {
                "paymentDate": "2022-08-10",
                "paymentMonth": 4845
            },
            {
                "paymentDate": "2022-08-11",
                "paymentMonth": 25555
            },
            {
                "paymentDate": "2022-08-12",
                "paymentMonth": 84844
            },



        ]
    };
    const months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];
    </script>
</body>

</html>