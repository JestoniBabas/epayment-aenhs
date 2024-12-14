
<script src="../js/fade.js"></script>
<script src="../js/chart.js"></script>
<script src="../js/footer.js"></script>

<script>

var xValues = ["Paid", "Unpaid", "To pay"];
var yValues = [<?=$payment_val;?>, <?=$payment_bal;?>, <?=$to_pay;?>];
var barColors = ["#9acd32", "#cd5c5c", "violet"];

new Chart("myChart1", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Chart Collections of payments"
    }
  }
});

var xValues = ["Male", "Female"];
var yValues = [<?=$male_students;?>, <?=$female_students;?>];
var barColors = ["#6495ed", "#ffb6c1"];

new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Overall Number of Male and Female"
    }
  }
});

</script>
</body>
</html>