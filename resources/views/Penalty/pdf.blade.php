<style>
    * {
        box-sizing: border-box;
    }

    /* Create a two-column layout */
    .column {
        float: left;
        width: 50%;
        padding: 5px;
    }

    /* Clearfix (clear floats) */
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
</style>

<table  width="100%" class="inlineTable">
        <tr>
            <td width="10%">
                <img src="{{ $logo }}" width="50" height="50" />
            </td>
            <td style="text-align: center">
                <b> Polytechnic University of the Philippines</b>
                <br>
                <b> Taguig Branch</b>
                <br>
                <b> Library Management System</b>
            </td>
        </tr>
</table>
<table  width="100%" class="inlineTable">
    <tr>
        <td><br></td>
    </tr>
</table>
<table  width="100%" class="inlineTable" >
    <tr>
        <td>Name: {{ $name }}</td>
        <td style="float: right;">Date: {{ date("Y-m-d") }}</td>
    </tr>
</table>
<br>
<table  width="50%" class="inlineTable">
    <tr>
        @if($student_number != "")
            <td>Student Number: {{ $student_number }}</td>
        @endif
        @if($faculty_number != "")
            <td>Faculty Number: {{ $faculty_number }}</td>
        @endif
        @if($employee_number != "")
            <td>Employee Number: {{ $employee_number }}</td>
        @endif
    </tr>
</table>
<br>
<table  width="100%" class="inlineTable" border="1" style="text-align: center">
    <thead>
        <tr>
            <th> Book Title</th>
            <th> Author</th>
            <th> Date Borrowed</th>
            <th> Due Date </th>
            <th> Date Returned</th>
            <th> Amount Due</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penalty as $data)
            <tr>
                <td>{{ $data->title }}</td>
                <td>{{ $data->author }}</td>
                <td>{{ $data->date_borrowed }}</td>
                <td>{{ $data->date_returned }}</td>
                <td>0000-00-00</td>
                <td>{{$amount_due}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<table  width="100%" class="inlineTable" >
    <tr>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td style="float: right;">Total Amount: {{ $amount_due }}</td>
    </tr>
</table>
<br>
<table  width="100%" class="inlineTable" >
    <tr>
        <td> Note: We will charge P{{ number_format($penalty_fee,2)}} a day for the late return of book/s. Please pay the amount due to the Cashiers Office. Thank you</td>
    </tr>
</table>
<br>
<table  width="100%" class="inlineTable"  style="text-align: center">
    <tr>
        <td>Signed By: </td>
    </tr>
</table>
<table  width="100%" class="inlineTable"  style="text-align: center">
    <tr>
        <td>_______________________________________</td>
    </tr>
</table>
<br>
<table  width="100%" class="inlineTable" style="text-align: center">
    <tr>
        <td>Elena C. Mamansag</td>
    </tr>
</table>
<table  width="100%" class="inlineTable" style="text-align: center">
    <tr>
        <td>Registered Librarian</td>
    </tr>
</table>


