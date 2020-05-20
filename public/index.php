<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<canvas id="myChart" width="400" height="150px"></canvas>


<script>

    let countries;

    function fetchData() {
        $.get("/getData.php", function (data) {
            countries = data;
            renderChart();
        });
    }

    function getLabels() {
        return countries.map(e => e.country);
    }

    function getValues() {
        return countries.map(e => e.count);
    }

    function renderChart() {
        var ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: getLabels(),
                datasets: [{
                    label: '# of Votes',
                    data: getValues(),
                    borderWidth: 1
                }]
            }
        });
    }

    fetchData();
</script>

</body>
</html>
