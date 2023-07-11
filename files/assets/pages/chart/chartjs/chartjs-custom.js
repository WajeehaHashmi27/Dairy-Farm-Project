"use strict";
$(document).ready(function () {
  var ctx = document.getElementById("myChart");
  var data = {
    labels: ["A", "B", "C", "D "],
    datasets: [
      {
        data: [40, 10, 40, 10],
        backgroundColor: ["#1ABC9C", "#FCC9BA", "#B8EDF0", "#B4C1D7"],
        borderWidth: ["0px", "0px", "0px", "0px"],
        borderColor: ["#1ABC9C", "#FCC9BA", "#B8EDF0", "#B4C1D7"],
      },
    ],
  };
  var myDoughnutChart = new Chart(ctx, { type: "doughnut", data: data });
  var data1 = {
    labels: [
      "11/7/23",
      "10/7/23",
      "9/7/23",
      "8/7/23",
      "7/7/23",
      "6/7/23",
      "5/7/23",
    ],
    datasets: [
      {
        label: "Feed Consumption",
        backgroundColor: [
          "rgba(95, 190, 170, 0.99)",
          "rgba(95, 190, 170, 0.99)",
          "rgba(95, 190, 170, 0.99)",
          "rgba(95, 190, 170, 0.99)",
          "rgba(95, 190, 170, 0.99)",
          "rgba(95, 190, 170, 0.99)",
          "rgba(95, 190, 170, 0.99)",
        ],
        hoverBackgroundColor: [
          "rgba(26, 188, 156, 0.88)",
          "rgba(26, 188, 156, 0.88)",
          "rgba(26, 188, 156, 0.88)",
          "rgba(26, 188, 156, 0.88)",
          "rgba(26, 188, 156, 0.88)",
          "rgba(26, 188, 156, 0.88)",
          "rgba(26, 188, 156, 0.88)",
        ],
        data: [125, 180, 150, 167, 200, 141, 173],
      },
      {
        label: "Milk Production",
        backgroundColor: [
          "rgba(93, 156, 236, 0.93)",
          "rgba(93, 156, 236, 0.93)",
          "rgba(93, 156, 236, 0.93)",
          "rgba(93, 156, 236, 0.93)",
          "rgba(93, 156, 236, 0.93)",
          "rgba(93, 156, 236, 0.93)",
          "rgba(93, 156, 236, 0.93)",
        ],
        hoverBackgroundColor: [
          "rgba(103, 162, 237, 0.82)",
          "rgba(103, 162, 237, 0.82)",
          "rgba(103, 162, 237, 0.82)",
          "rgba(103, 162, 237, 0.82)",
          "rgba(103, 162, 237, 0.82)",
          "rgba(103, 162, 237, 0.82)",
          "rgba(103, 162, 237, 0.82)",
        ],
        data: [180, 160, 175, 170, 143, 187, 160],
      },
    ],
  };
  var bar = document.getElementById("barChart").getContext("2d");
  var myBarChart = new Chart(bar, {
    type: "bar",
    data: data1,
    options: { barValueSpacing: 20 },
  });
});
