jQuery(function($){
    // 有給の有効化/無効化
    $('.check_paid_vacation').change(function(){
        var isChecked = $(this).prop('checked'),
            parent = $(this).closest('tr'),
            date = parent.data('date'),
            shiftType = $(this).closest('table').data('shift-type'),
            shiftBegin = shiftEnd = '',
            selectOptions = '<option value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option>';
            // console.log(shiftType);

        if (shiftType == 'E') {
            var shiftBegin = '5',
                shiftEnd = '13';
        } else if (shiftType == 'M') {
            var shiftBegin = '13',
                shiftEnd = '21';
        } else if (shiftType == 'L') {
            var shiftBegin = '21',
                shiftEnd = '5';
        } // console.log(shiftBegin);

        if (isChecked) {
            parent.find('.paid_vacation_time')
                .data('diff', 8)
                .html('')
                .append('<input type="hidden" name="TimeCard['+date+'][paid_vacation_diff]" value="8"> 8');

            parent.find('.paid_vacation_time_range')
                .addClass('editable')
                .html('')
                .append('<div class="form-group text">'+
                    '<select name="TimeCard['+date+'][paid_vacation_start_time]" class="form-control paid_vacation_start_time">'+
                    selectOptions +
                    '</select>' +
                    ' ～ '+
                    '<select name="TimeCard['+date+'][paid_vacation_end_time]" class="form-control paid_vacation_end_time">'+
                    selectOptions +
                    '</select>' +
                '</div>');
            parent.find('.paid_vacation_start_time').val(shiftBegin);
            parent.find('.paid_vacation_end_time').val(shiftEnd);
        } else {
            parent.find('.paid_vacation_time, .paid_vacation_time_range')
                .removeClass('editable')
                .html('' +
                    '<input type="hidden" name="TimeCard['+date+'][paid_vacation_diff]" value="0">' +
                    '<input type="hidden" name="TimeCard['+date+'][paid_vacation_start_time]" value="">' +
                    '<input type="hidden" name="TimeCard['+date+'][paid_vacation_end_time]" value="">' +
                '');

            parent.find('.paid_vacation_time')
                .data('diff', 0);
        }

        calcAll();
    });

    // 有給の変更時
    $(document).on('change', '.paid_vacation_start_time, .paid_vacation_end_time', function(){
        var result = 0,
            date = $(this).closest('tr').data('date'),
            beginTime = parseInt($(this).closest('tr').find('.paid_vacation_start_time').val()),
            endTime = parseInt($(this).closest('tr').find('.paid_vacation_end_time').val()),
            target = $(this).closest('tr').find('.paid_vacation_time');

        if (beginTime < endTime) {
            result = endTime - beginTime;
        } else {
            result = endTime + 24 - beginTime;
        }

        target.data('diff', result);
        target.html('<input type="hidden" name="TimeCard['+date+'][paid_vacation_diff]" value="'+result+'"> '+result);

        calcAll();
    });

    // 労働時間の計算
    function calcAll() {
        var $tbody = $('#time-cards tbody'),
            $summaryWorkingDays = 0;

        // Initialize summary data
        var $summary = new Object();
        $summary.regularAmount = 0;
        $summary.midnightAmount = 0;
        $summary.normalWorkingHours = 0;
        $summary.nightWorkingHours = 0;
        $summary.paidNormalWorkingHours = 0;
        $summary.paidNightWorkingHours = 0;
        $summary.paidVacationHours = 0;
        $summary.totalWorkingHours = 0;
        $summary.normalWorkingAmount = 0;
        $summary.nightWorkingAmount = 0;
        $summary.paidNormalWorkingAmount = 0;
        $summary.paidNightWorkingAmount = 0;
        $summary.over = 0;
        $summary.overDays = 0;
        $summary.overWorkingAmount = 0;

        // Looooop each tr
        $('tr', $tbody).each(function(){
            var $row = $(this),
                $date = $row.data('date'),
                $result = 0;

            // raw times
            var $raw_in_time = $('.in_time input', $row).data('full-date');
            var $raw_out_time = $('.out_time input', $row).data('full-date');
            var $raw_in_time2 = $('.in_time2 input', $row).data('full-date');
            var $raw_out_time2 = $('.out_time2 input', $row).data('full-date');
            var $raw_schedules_in_time = $('.schedules_in_time input', $row).data('full-date');
            var $raw_schedules_out_time = $('.schedules_out_time input', $row).data('full-date');
            var $raw_schedules_in_time2 = $('.schedules_in_time2 input', $row).data('full-date');
            var $raw_schedules_out_time2 = $('.schedules_out_time2 input', $row).data('full-date');

            // DIFF: schedules_in_time & schedules_out_time
            if ($raw_schedules_in_time != '' && $raw_schedules_out_time != '') {
                var $schedules_in_time = roundMinutes(moment($raw_schedules_in_time), 'in'),
                    $schedules_out_time = roundMinutes(moment($raw_schedules_out_time), 'out');

                $result += $schedules_out_time.diff($schedules_in_time, 'minutes');
            } else {
                // DIFF: in_time & out_time
                if ($raw_in_time != '' && $raw_out_time != '') {
                    var $in_time = roundMinutes(moment($raw_in_time), 'in'),
                        $out_time = roundMinutes(moment($raw_out_time), 'out');

                    $result += $out_time.diff($in_time, 'minutes');
                }
            }

            // DIFF: schedules_in_time2 & schedules_out_time2
            if ($raw_schedules_in_time2 != '' && $raw_schedules_out_time2 != '') {
                var $schedules_in_time2 = roundMinutes(moment($raw_schedules_in_time2), 'in'),
                    $schedules_out_time2 = roundMinutes(moment($raw_schedules_out_time2), 'out');

                $result += $schedules_out_time2.diff($schedules_in_time2, 'minutes');
            } else {
                // DIFF: in_time2 & out_time2
                if ($raw_in_time2 != '' && $raw_out_time2 != '') {
                    var $in_time2 = roundMinutes(moment($raw_in_time2), 'in'),
                        $out_time2 = roundMinutes(moment($raw_out_time2), 'out');

                    $result += $out_time2.diff($in_time2, 'minutes');
                }
            }

            // ADD paid_vacation
            $result += parseInt($('.paid_vacation_time', $row).data('diff')) * 60;

            // Increment summary of paid vacation days
            if (parseInt($('.paid_vacation_time', $row).data('diff')) > 0) {
                $summary.overDays++;
            }

            // Set results
            var result_diff = $result / 60;

            if (result_diff > 0) {
                $('.diff', $row).html(result_diff.toFixed(1) + '<input type="hidden" name="TimeCard['+$date+'][work_time]" value="' + result_diff + '">');
                $summaryWorkingDays++;
            } else {
                $('.diff', $row).html('<input type="hidden" name="TimeCard['+$date+'][work_time]" value="0">');
            }

            if (result_diff > 8) {
                $('.over', $row).html((result_diff - 8).toFixed(1) + '<input type="hidden" name="TimeCard['+$date+'][over_time]" value="' + (result_diff - 8) + '">');
            } else {
                $('.over', $row).html('<input type="hidden" name="TimeCard['+$date+'][over_time]" value="0">');
            }

            // console.log($result);

            var $currentSummary = getDetailsByRow($row);
            // console.log($currentSummary);

            $summary.regularAmount += $currentSummary.regularAmount;
            $summary.midnightAmount += $currentSummary.midnightAmount;
            $summary.normalWorkingHours += $currentSummary.normalWorkingHours;
            $summary.nightWorkingHours += $currentSummary.nightWorkingHours;
            $summary.paidNormalWorkingHours += $currentSummary.paidNormalWorkingHours;
            $summary.paidNightWorkingHours += $currentSummary.paidNightWorkingHours;
            $summary.paidVacationHours += $currentSummary.paidVacationHours;
            $summary.totalWorkingHours += $currentSummary.totalWorkingHours - $currentSummary.paidVacationHours;
            $summary.normalWorkingAmount += $currentSummary.normalWorkingAmount;
            $summary.nightWorkingAmount += $currentSummary.nightWorkingAmount;
            $summary.paidNormalWorkingAmount += $currentSummary.paidNormalWorkingAmount;
            $summary.paidNightWorkingAmount += $currentSummary.paidNightWorkingAmount;
            $summary.over += $currentSummary.over;
            $summary.overWorkingAmount += $currentSummary.overWorkingAmount;
            // console.log($summary);
        }); // End of $('tr', $tbody).each()

        /**
         * Set summary
         */
        var $summaryRow = $('#summary tbody');

        // Set working days
        $('.working-days', $summaryRow).html('' +
            $summaryWorkingDays + '日 / ' + $('tr', $tbody).length + '日' +
            '<input type="hidden" name="MonthlyTimeCards[total_working_days]" value="' + $summaryWorkingDays + '">' +
            '<input type="hidden" name="MonthlyTimeCards[total_days]" value="' + $('tr', $tbody).length + '">' +
        '');

        // Set 総労働時間
        $('.total-working-hours', $summaryRow).html('' +
            ($summary.totalWorkingHours + $summary.paidNormalWorkingHours + $summary.paidNightWorkingHours).toFixed(1) + 'H<br>' +
            ($summary.normalWorkingAmount + $summary.nightWorkingAmount + $summary.paidNormalWorkingAmount + $summary.paidNightWorkingAmount + $summary.overWorkingAmount).toLocaleString() + '円' +
            '<input type="hidden" name="MonthlyTimeCards[total_working_hours]" value="' + ($summary.totalWorkingHours + $summary.paidNormalWorkingHours + $summary.paidNightWorkingHours) + '">' +
            '<input type="hidden" name="MonthlyTimeCards[total_working_amount]" value="' + ($summary.normalWorkingAmount + $summary.nightWorkingAmount + $summary.paidNormalWorkingAmount + $summary.paidNightWorkingAmount + $summary.overWorkingAmount) + '">' +
        '');

        // Set 通常
        $('.normal-working-hours', $summaryRow).html('' +
            ($summary.normalWorkingHours + $summary.paidNormalWorkingHours).toFixed(1) + 'H<br>' +
            ($summary.normalWorkingAmount + $summary.paidNormalWorkingAmount).toLocaleString() + '円' +
            '<input type="hidden" name="MonthlyTimeCards[normal_working_hours]" value="' + $summary.normalWorkingHours + '">' +
            '<input type="hidden" name="MonthlyTimeCards[normal_working_amount]" value="' + $summary.normalWorkingAmount + '">' +
            '<input type="hidden" name="MonthlyTimeCards[paid_vacation_normal_amount]" value="' + $summary.paidNormalWorkingAmount + '">' +
        '');

        // Set 深夜
        $('.midnight-working-hours', $summaryRow).html('' +
            ($summary.nightWorkingHours + $summary.paidNightWorkingHours).toFixed(1) + 'H<br>' +
            ($summary.nightWorkingAmount + $summary.paidNightWorkingAmount).toLocaleString() + '円' +
            '<input type="hidden" name="MonthlyTimeCards[midnight_working_hours]" value="' + $summary.nightWorkingHours + '">' +
            '<input type="hidden" name="MonthlyTimeCards[midnight_working_amount]" value="' + $summary.nightWorkingAmount + '">' +
            '<input type="hidden" name="MonthlyTimeCards[paid_vacation_midnight_amount]" value="' + $summary.paidNightWorkingAmount + '">' +
        '');

        // Set 残業
        $('.over', $summaryRow).html('' +
            $summary.over.toFixed(1) + 'H<br>' +
            $summary.overWorkingAmount.toLocaleString() + '円' +
            '<input type="hidden" name="MonthlyTimeCards[over_working_hours]" value="' + $summary.over + '">' +
            '<input type="hidden" name="MonthlyTimeCards[over_working_amount]" value="' + $summary.overWorkingAmount + '">' +
        '');

        // Set 有給
        $('.paid-vacation-hours', $summaryRow).html('' +
            $summary.overDays + '日　　' + $summary.paidVacationHours.toFixed(1) + 'H<br>' +
            '通常 ' + $summary.paidNormalWorkingHours.toFixed(1) + 'H　　' +
            '深夜 ' + $summary.paidNightWorkingHours.toFixed(1) + 'H' +
            '<input type="hidden" name="MonthlyTimeCards[paid_vacation_days]" value="' + $summary.overDays + '">' +
            '<input type="hidden" name="MonthlyTimeCards[paid_vacation_hours]" value="' + $summary.paidVacationHours + '">' +
            '<input type="hidden" name="MonthlyTimeCards[paid_vacation_hours_normal]" value="' + $summary.paidNormalWorkingHours + '">' +
            '<input type="hidden" name="MonthlyTimeCards[paid_vacation_hours_midnight]" value="' + $summary.paidNightWorkingHours + '">' +
        '');
    } calcAll();

    // 値を変更したら計算し直し
    $('#time-cards tbody input.is-time').change(function(){
        // NULL check
        if ($(this).val() == '') {
            $(this).data('full-date', '');

            return;
        } else {
            if (!$(this).val().match(/^[0-9]{2}:[0-9]{2}$/)) {
                alert($(this).val() + ' は正しい時刻ではありません。');

                return;
            }
        }

        var date = $(this).closest('tr').data('date'),
            input = $(this).val().split(':'),
            addDay = false;

        if (parseInt(input[0]) >= 24) {
            input[0] = input[0] - 24;
            addDay = true;
        }

        var m = moment(date + ' ' + input[0] + ':' + input[1]);

        if (addDay) {
            m.add(1, 'days');
        }

        $(this).data('full-date', m.format('YYYY-MM-DD HH:mm'));

        // console.log($(this).data('full-date'));

        calcAll();
    });

    // moment オブジェクトの時刻を30分間隔で丸める
    function roundMinutes(m, type) {
        if (type == 'in') {
            if (m.minutes() == 0) {
                m.minutes(0);
            } else if (m.minutes() > 30) {
                m.minutes(0);
                m.add(1, 'hours');
            } else {
                m.minutes(30);
            }
        } else { // 退勤(out)の場合は逆方向に丸める
            if (m.minutes() < 30) {
                m.minutes(0);
            } else {
                m.minutes(30);
            }
        }

        // console.log(m.format('HH:mm'));

        return m;
    }

    // 指定された行から「通常出勤」「深夜出勤」「有給」「総労働時間」「残業」を取得
    function getDetailsByRow($row) {
        var $regularAmount = parseInt($('#user-info').data('regular-amount')),
            $midnightAmount = parseInt($('#user-info').data('midnight-amount')),
            $normalWorkingHours = 0,
            $nightWorkingHours = 0,
            $paidNormalWorkingHours = 0,
            $paidNightWorkingHours = 0,
            $paidVacationHours = 0,
            $totalWorkingHours = 0,
            $normalWorkingAmount = 0,
            $nightWorkingAmount = 0,
            $paidNormalWorkingAmount = 0,
            $paidNightWorkingAmount = 0,
            $over = 0,
            $overWorkingAmount = 0,
            $date = $row.closest('tr').data('date');

        // raw times
        var $raw_in_time = $('.in_time input', $row).data('full-date');
        var $raw_out_time = $('.out_time input', $row).data('full-date');
        var $raw_in_time2 = $('.in_time2 input', $row).data('full-date');
        var $raw_out_time2 = $('.out_time2 input', $row).data('full-date');
        var $raw_schedules_in_time = $('.schedules_in_time input', $row).data('full-date');
        var $raw_schedules_out_time = $('.schedules_out_time input', $row).data('full-date');
        var $raw_schedules_in_time2 = $('.schedules_in_time2 input', $row).data('full-date');
        var $raw_schedules_out_time2 = $('.schedules_out_time2 input', $row).data('full-date');

        // Calculate 総労働時間
        if ($('.diff', $row).text().length) {
            $totalWorkingHours = parseFloat($('.diff', $row).text());

            if (isNaN($totalWorkingHours)) {
                $totalWorkingHours = 0;
            }
        } // console.log($date + ': 総労働時間: ' + $totalWorkingHours);

        // Calculate 有給
        if ($('.paid_vacation_time', $row).text().length) {
            $paidVacationHours = parseFloat($('.paid_vacation_time', $row).text());

            if (isNaN($paidVacationHours)) {
                $paidVacationHours = 0;
            }
        } // console.log($date + ': 有給: ' + $paidVacationHours);

        // Calculate 残業
        if ($('.over', $row).text().length) {
            $over = parseFloat($('.over', $row).text());

            if (isNaN($over)) {
                $over = 0;
            }
        } // console.log($date + ': 残業: ' + $over);

        // 実際の出勤より予定出勤を優先
        if ($raw_schedules_in_time != '' && $raw_schedules_out_time != '') {
            $raw_in_time = $raw_schedules_in_time;
            $raw_out_time = $raw_schedules_out_time;
        }
        if ($raw_schedules_in_time2 != '' && $raw_schedules_out_time2 != '') {
            $raw_in_time2 = $raw_schedules_in_time2;
            $raw_out_time2 = $raw_schedules_out_time2;
        }

        /**
         * in_time & out_time
         *
         * 通常: 5-22
         * 深夜: 22-5 (27)
         */
        if ($raw_in_time != '' && $raw_out_time != '') {
            var $in_time = roundMinutes(moment($raw_in_time), 'in'),
                $out_time = roundMinutes(moment($raw_out_time), 'out'),
                $out_time_copy = $out_time.format('YYYY-MM-DD HH:mm');

            if ($out_time.isAfter($in_time)) {
                var $temp_out_time = roundMinutes(moment($raw_in_time), 'in');
                while ($in_time.format('YYYY-MM-DD HH:mm') != $out_time_copy) {
                    var $in_hour = parseInt($in_time.format('HH')),
                        $out_hour = parseInt($out_time.format('HH'));

                    $temp_out_time.add(30, 'minutes');
                    var $temp_out_hour = parseInt($temp_out_time.format('HH')),
                        $temp_out_min = parseInt($temp_out_time.format('mm'));

                    if ($in_hour > $out_hour) {
                        $out_hour += 24;
                    }

                    if ($in_hour >= 5 && $in_hour < 22 && $temp_out_hour < 22 || $in_hour >= 5 && $in_hour < 22 && $temp_out_hour == 22 && $temp_out_min == 0) {
                        // 通常
                        $normalWorkingHours += 0.5;
                        // console.log('通常: ' + $in_time.format('HH:mm') + ' ～ ' + $temp_out_time.format('HH:mm'));
                    } else {
                        // 深夜
                        $nightWorkingHours += 0.5;
                        // console.log('深夜: ' + $in_time.format('HH:mm') + ' ～ ' + $temp_out_time.format('HH:mm'));
                    }

                    $in_time.add(30, 'minutes');
                }
            }
        }

        /**
         * in_time2 & out_time2
         *
         * 通常: 5-22
         * 深夜: 22-5 (27)
         */
        if ($raw_in_time2 != '' && $raw_out_time2 != '') {
            var $in_time2 = roundMinutes(moment($raw_in_time2), 'in'),
                $out_time2 = roundMinutes(moment($raw_out_time2), 'out'),
                $out_time2_copy = $out_time2.format('YYYY-MM-DD HH:mm');

            if ($out_time2.isAfter($in_time2)) {
                var $temp_out_time2 = roundMinutes(moment($raw_in_time2), 'in');
                while ($in_time2.format('YYYY-MM-DD HH:mm') != $out_time2_copy) {
                    var $in_hour = parseInt($in_time2.format('HH')),
                        $out_hour = parseInt($out_time2.format('HH'));

                    $temp_out_time2.add(30, 'minutes');
                    var $temp_out_hour = parseInt($temp_out_time2.format('HH')),
                        $temp_out_min = parseInt($temp_out_time2.format('mm'));

                    if ($in_hour > $out_hour) {
                        $out_hour += 24;
                    }

                    if ($in_hour >= 5 && $in_hour < 22 && $temp_out_hour < 22 || $in_hour >= 5 && $in_hour < 22 && $temp_out_hour == 22 && $temp_out_min == 0) {
                        // 通常
                        $normalWorkingHours += 0.5;
                        // console.log('通常: ' + $in_time2.format('HH:mm') + ' ～ ' + $temp_out_time2.format('HH:mm'));
                    } else {
                        // 深夜
                        $nightWorkingHours += 0.5;
                        // console.log('深夜: ' + $in_time2.format('HH:mm') + ' ～ ' + $temp_out_time2.format('HH:mm'));
                    }

                    $in_time2.add(30, 'minutes');
                }
            }
        }

        /**
         * paid_vacation_start_time & paid_vacation_end_time
         *
         * 通常: 5-22
         * 深夜: 22-5 (27)
         */
        if ($('.paid_vacation_start_time', $row).length && $('.paid_vacation_end_time', $row).length) {
            var $in_hour = parseInt($('.paid_vacation_start_time', $row).val()),
                $out_hour = parseInt($('.paid_vacation_end_time', $row).val()),
                $paid_in_time = moment($date + ' ' + $in_hour + ':00:00'),
                $paid_out_time = moment($date + ' ' + $out_hour + ':00:00');

            if ($in_hour > $out_hour) {
                $paid_out_time.add(1, 'days');
            }

            var $paid_out_time_copy = $paid_out_time.format('YYYY-MM-DD HH:mm');

            if ($paid_out_time.isAfter($paid_in_time)) {
                var $temp_out_time = moment($date + ' ' + $in_hour + ':00:00');
                while ($paid_in_time.format('YYYY-MM-DD HH:mm') != $paid_out_time_copy) {
                    var $in_hour = parseInt($paid_in_time.format('HH')),
                        $out_hour = parseInt($paid_out_time.format('HH'));

                    $temp_out_time.add(30, 'minutes');
                    var $temp_out_hour = parseInt($temp_out_time.format('HH')),
                        $temp_out_min = parseInt($temp_out_time.format('mm'));

                    if ($in_hour > $out_hour) {
                        $out_hour += 24;
                    }

                    if ($in_hour >= 5 && $in_hour < 22 && $temp_out_hour < 22 || $in_hour >= 5 && $in_hour < 22 && $temp_out_hour == 22 && $temp_out_min == 0) {
                        // 通常
                        $paidNormalWorkingHours += 0.5;
                        // console.log('通常: ' + $paid_in_time.format('HH:mm') + ' ～ ' + $temp_out_time.format('HH:mm'));
                    } else {
                        // 深夜
                        $paidNightWorkingHours += 0.5;
                        // console.log('深夜: ' + $paid_in_time.format('HH:mm') + ' ～ ' + $temp_out_time.format('HH:mm'));
                    }

                    $paid_in_time.add(30, 'minutes');
                }
            }
        }

        // console.log($date + ': 有給の通常時間: ' + $paidNormalWorkingHours);
        // console.log($date + ': 有給の深夜時間: ' + $paidNightWorkingHours);

        // 給与計算 (通常/深夜)
        $normalWorkingAmount = $regularAmount * $normalWorkingHours;
        $nightWorkingAmount = $midnightAmount * $nightWorkingHours;

        // 給与計算 (残業)
        $overWorkingAmount = $regularAmount * 0.25 * $over;

        // 給与計算 (有給)
        $paidNormalWorkingAmount = $regularAmount * $paidNormalWorkingHours;
        $paidNightWorkingAmount = $midnightAmount * $paidNightWorkingHours;

        // console.log($date + ': 通常給与: ' + $normalWorkingAmount);
        // console.log($date + ': 深夜給与: ' + $nightWorkingAmount);

        // Return
        var ret = new Object();
        ret.regularAmount = !isNaN($regularAmount) ? $regularAmount : 0;
        ret.midnightAmount = !isNaN($midnightAmount) ? $midnightAmount : 0;
        ret.normalWorkingHours = !isNaN($normalWorkingHours) ? $normalWorkingHours : 0;
        ret.nightWorkingHours = !isNaN($nightWorkingHours) ? $nightWorkingHours : 0;
        ret.paidNormalWorkingHours = !isNaN($paidNormalWorkingHours) ? $paidNormalWorkingHours : 0;
        ret.paidNightWorkingHours = !isNaN($paidNightWorkingHours) ? $paidNightWorkingHours : 0;
        ret.paidVacationHours = !isNaN($paidVacationHours) ? $paidVacationHours : 0;
        ret.totalWorkingHours = !isNaN($totalWorkingHours) ? $totalWorkingHours : 0;
        ret.normalWorkingAmount = !isNaN($normalWorkingAmount) ? $normalWorkingAmount : 0;
        ret.nightWorkingAmount = !isNaN($nightWorkingAmount) ? $nightWorkingAmount : 0;
        ret.paidNormalWorkingAmount = !isNaN($paidNormalWorkingAmount) ? $paidNormalWorkingAmount : 0;
        ret.paidNightWorkingAmount = !isNaN($paidNightWorkingAmount) ? $paidNightWorkingAmount : 0;
        ret.over = !isNaN($over) ? $over : 0;
        ret.overWorkingAmount = !isNaN($overWorkingAmount) ? $overWorkingAmount : 0;

        // console.log(ret);

        return ret;
    }
});
