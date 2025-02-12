<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTR Report</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- hedvig font --}}
    <link href="https://fonts.googleapis.com/css2?family=Hedvig+Letters+Sans&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Hedvig Letters Sans", sans-serif;
        }

        /* Flex utility */
        .flex-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            width: 100%;
        }

        .flex-between p,
        .flex-between img {
            display: inline-block;
            /* Makes sure text elements behave properly inside flex */
            margin: 0;
            /* Removes default margin */
            align-items: center;
            justify-content: space-between;
        }

        /* Logo styles */
        .rweb-logo,
        .sti-logo {
            width: auto;
            height: 50px;
            /* Adjust as needed */
        }

        /* Header */
        .header {
            text-align: center;
            margin: 20px 0;
        }

        .header h4 {
            font-weight: bold;
            color: #F57D11;
            margin: 0;
            /* Custom orange */
        }

        .header h1 {
            font-size: 24px;
            margin-top: 5px;
        }

        /* Info Section */
        .info {
            margin: 20px 0;
        }

        .info p {
            margin: 5px 0;
        }

        .capitalize {
            text-transform: capitalize;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #F57D11;
            color: white;
        }

        .flex {
            display: flex;
            flex-direction: row;
            width: max-content;
            margin: 0;
        }

        .flex p,
        .flex img {
            align-items: center;
            display: flex;
            justify-content: space-between;
            width: auto;
            margin: 0;
        }
    </style>
</head>

<body class="hedvig-letters-sans-regular">
    <div class="flex">
        <img class="rweb-logo" src="resources/img/rweb_logo.png" alt="sti-logo">
        <img class="sti-logo" src="resources/img/school-logo/sti.png" alt="sti-logo">
    </div>

    <div class="header">
        <h4>OJT Daily Time Record</h4>
        <h1>{{ $month }}</h1>
    </div>

    <hr>

    <div class="info">
        <p class="capitalize"><strong>Name:</strong> {{ $name }}</p>
        <p><strong>Position:</strong> {{ $position }}</p>
        <div class="flex">
            <p><strong>Hours This Month:</strong> {{ $hoursThisMonth }}</p>
            <p><strong>Approved By:</strong> ______________</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Total Hours</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($days as $day)
                <tr>
                    <td>{{ $day }}</td>
                    <td>8:00 AM</td>
                    <td>6:00 PM</td>
                    <td>8 Hours</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
