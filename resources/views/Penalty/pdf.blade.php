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
        <td style="float: right;">Date: {{ date("F d, Y") }}</td>
    </tr>
</table>

<br>

<table  width="50%" class="inlineTable">
    <tr>
        @if($student_number !== "" && $student_number !== NULL)
            <td>Student Number: {{ $student_number }}</td>
        @endif
        @if($faculty_number !== "" && $faculty_number !== NULL)
            <td>Faculty Number: {{ $faculty_number }}</td>
        @endif
        @if($employee_number !== "" && $employee_number !== NULL)
            <td>Employee Number: {{ $employee_number }}</td>
        @endif
    </tr>
</table>

<br>

<table  width="100%" class="inlineTable" border="1" style="text-align: center">
    <thead>
        <tr>
            <th>Book Title</th>
            <th style="width:15%;">Date Borrowed</th>
            <th style="width:15%;">Due Date</th>
            <th style="width:12%;">Days Overdue</th>
            <th style="width:18%;">Amount Due</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ $penalty->borrowing->materialCopy->material->title }}
                <br>
                {{ $penalty->borrowing->materialCopy->material->isbn }}
                <br>
                ({{ $penalty->borrowing->materialCopy->accession_number }})
            </td>
            <td>{{ $penalty->borrowing->formatted_date_borrowed }}</td>
            <td>{{ $penalty->borrowing->formatted_date_returned }}</td>
            <td>{{ $penalty->penalty_days }} days</td>
            <td>P{{$amount_due}}</td>
        </tr>
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
        <td> Note: We will charge P{{ $penalty_fee }} a day for the late return of book/s. Please pay the amount due to the Cashiers Office. Thank you</td>
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