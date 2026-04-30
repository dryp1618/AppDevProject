const pie = document.getElementById("pieChart");
const bar = document.getElementById("barChart");
const line = document.getElementById("lineChart");

new Chart(pie, {
  type: "doughnut",
  data: {
    labels: window.PieData.labels,
    datasets: [
      {
        label: "Percentage of current room statuses",
        data: window.PieData.data,
        borderWidth: 2,
        backgroundColor: [
          "#F1948A",
          "#82E0AA",
          "#85C1E9",
          "#BFC9CA",
        ],
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
  },
});

new Chart(bar, {
  type: "bar",
  data: {
    labels: window.BarData.labels,
    datasets: [
      {
        label: "Most used Room Today (Total Hours)",
        data: window.BarData.data,
        borderWidth: 1,
        borderColor: "#FF6384",
        backgroundColor: "#FFB1C1",
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
new Chart(line, {
  type: "line",
  data: {
    labels: window.LineData.labels,
    datasets: [
      {
        label: "Free Room Hours per Day",
        data: window.LineData.data,
        borderWidth: 1,
        borderColor: "#84b664",
        backgroundColor: "#b4e694",
      },
    ],
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
