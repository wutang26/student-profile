<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Students Statistics</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      background:#f3f4f6;
      padding:20px;
    }

    .card {
      background:#fff;
      max-width:900px;
      margin:auto;
      padding:20px;
      border-radius:12px;
      box-shadow:0 2px 10px rgba(0,0,0,0.08);
    }

    .title {
      font-size:20px;
      font-weight:bold;
      margin-bottom:10px;
    }

    .subtitle {
      font-size:13px;
      color:#666;
      margin-bottom:20px;
    }

    #container {
      height:400px;
    }
  </style>
</head>

<body>

<div class="card">

  <div class="title">Joined Students Overview</div>
  <div class="subtitle">TPS Moshi - Company Performance by Region</div>

  <div id="container"></div>

</div>

<script src="https://code.highcharts.com/highcharts.js"></script>

<script>
Highcharts.chart('container', {
    chart: {
        type: 'column',
        backgroundColor: 'transparent'
    },

    title: {
        text: ''
    },

    xAxis: {
        categories: ['HQ', 'A-Coy', 'B-Coy', 'C-coy', 'D-Coy', 'E-Coy']
    },

    yAxis: {
        title: {
            text: 'Number of Students'
        }
    },

    legend: {
        enabled: false
    },

    series: [{
        name: 'Students',
        data: [120, 200, 150, 80, 60, 90],
        color: '#2563eb'
    }]
});
</script>

</body>
</html>