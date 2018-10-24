
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<!DOCTYPE HTML>
<body>
    <form method="post" action="">
        <?php echo '<br>';
        echo '<br>';
        ?>
        <b> Month : </b>
        <select id="getMonth" name="getMonth">
            <option value="">--Select--</option>
            <option value="1">Jan</option>
            <option value="2">Feb</option>
            <option value="3">Mar</option>
            <option value="4">Apr</option>
            <option value="5">May</option>
            <option value="6">Jun</option>
            <option value="7">Jul</option>
            <option value="8">Aug</option>
            <option value="9">Sep</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>

        &nbsp;

        <b> Year : </b>
        <input type="text" name="getYear" id="getYear" autocomplete="off" placeholder="Enter Year..">

<?php echo '<br>';
echo '<br>'; ?>

        <div class="btncls">
            <button type="submit" value="Submit" onclick="return formSubmit();">Get Calendar</button>
            <button type="Cancel" value="Clear" onclick="return formClear();">Clear</button>
        </div>

        <?php
        error_reporting('E_ALL');
        if (isset($_POST['getYear']) && isset($_POST['getMonth'])) {
            $year = $_POST['getYear'];
            $month = $_POST['getMonth'];

            if (!empty($year) && !empty($month)) {

                $date = time();
                echo '<br>';
                $first_day = mktime(0, 0, 0, $month, 1, $year);
                $title = date('F', $first_day);
                $day_of_week = date('D', $first_day);

                switch ($day_of_week) {
                    case "Sun": $blank = 0;
                        break;
                    case "Mon": $blank = 1;
                        break;
                    case "Tue": $blank = 2;
                        break;
                    case "Wed": $blank = 3;
                        break;
                    case "Thu": $blank = 4;
                        break;
                    case "Fri": $blank = 5;
                        break;
                    case "Sat": $blank = 6;
                        break;
                }

                $days_in_month = cal_days_in_month(0, $month, $year);
                echo '<br>';
                echo '<table id = "calendar">';

                echo '<tr>';
                echo '<th colspan=60>' . $title . ' - ' . $year . '</th>';
                echo '</tr>';

                echo '<tr class="empty">';
                echo '<td colspan=60></td>';
                echo '</tr>';

                echo '<tr class="weekdays">';
                echo '<td>S</td>';
                echo '<td>M</td>';
                echo '<td>T</td>';
                echo '<td>W</td>';
                echo '<td>T</td>';
                echo '<td>F</td>';
                echo '<td>S</td>';
                echo '</tr>';

                $day_count = 1;

                while ($blank > 0) {
                    echo '<td class="weeknum">*</td>';
                    $blank = $blank - 1;
                    $day_count++;
                }

                $day_num = 1;

                while ($day_num <= $days_in_month) {

                    echo '<td class="weeknum">' . $day_num . '</td>';
                    $day_num++;
                    $day_count++;

                    if ($day_count > 7) {
                        echo '<tr>';
                        $day_count = 1;
                    }
                }

                while ($day_count > 1 && $day_count <= 7) {
                    echo '<td class="weeknum"> *</td>';
                    $day_count++;
                }

                echo '</tr>';

                echo '</table>';
            }
        }
        ?>
    </form> 
</body>

<script type="text/javascript">

    document.getElementById('getMonth').value = "<?php echo $_POST['getMonth']; ?>";
    document.getElementById('getYear').value = "<?php echo $_POST['getYear']; ?>";

    function formSubmit() {
        if ($('#getMonth').val() == 0) {
            $('#calendar').hide();
            alert('Please Select any Month');
            e.preventDefault();
            $('#getMonth').focus();
            return false;
        }
        if ($('#getYear').val() == '') {
            $('#calendar').hide();
            alert('Please Enter any Year');
            $('#getYear').focus();
            return false;
        }

        var regex = new RegExp(/(\d{4}|\d{4}\-\d{4})$/g);
        var value = $('#getYear').val();
        var result = regex.test(value);

        if (result == false) {
            $('#calendar').hide();
            alert("Please Enter Valid Year");
            $('#getYear').val('');
            $('#getYear').focus();
            return false;
        }

        var year = $('#getYear').val();
        var currYear = "2037";
        if (year < 1902 || year > currYear) {
            $('#calendar').hide();
            alert(year + ' is an invalid year ! Enter a Valid Url');
            $('#getYear').val('');
            $('#getYear').focus();
            return false;
        }

    }

    function formClear() {
        $('#getMonth').val('0');
        $('#getYear').val('');
        return true;
    }
</script>

<style>

    #calendar {
        border: 1px solid black;
        border-collapse: collapse;
        width: 100%;
        margin-left: -50px;
    }
    table,tr {
        border-collapse: collapse;
        border: 2px solid black;
        border-color: #ccf2ff;
        outline-width: thick;
    }
    .empty{
        border: 2px solid black;
        border-right:2px solid red; 
        border-left:2px solid red; 
        height: 11px;
    }
    #calendar th {
        height: 50px;
        text-align: center;
        background-color: #004466;
        color: white;  
        font-family: sans-serif;
        font-size: 25px;
        border: 2px solid black;
    }
    #calendar td.weeknum{
        height: 50px;
        text-align: center;
        color: #08840a; 
        font-weight: bold;
        font-family: sans-serif;
        font-size: 21px;
    }
    #calendar tr.weekdays {  
        height: 50px;
        text-align: center;
        background-color: #ff0000;
        color: white;  
        border: 2px solid black;
        border-bottom:  none;
        font-size: 25px;
        font-family: sans-serif;
    }
    body {
        margin: 0;
        padding: 0;
    }
    form {
        width: 450px;
        margin: 0 auto;
    }
    .btncls{
        margin-left: 85px;
    }
    input {
        width: 20%;
    }
    input,select,button {
        padding:3px;
        margin: 0;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius:4px;
        -webkit-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
        -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
        box-shadow: 0 3px 0 #ccc, 0 -1px #fff inset;
        outline:none;
        display: inline-block;
        -moz-appearance:none;
        appearance:none;
        cursor:pointer;
    }
    /* Targetting Webkit browsers only. FF will show the dropdown arrow with so much padding. */
    @media screen and (-webkit-min-device-pixel-ratio:0) {
        input,select,button {padding-right:15px}
    }
</style>