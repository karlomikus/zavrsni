var ctx = $("#projects-chart").get(0).getContext("2d");

$.getJSON( "/admin/charts/projects/2015", function(jsonData)
{
    var data = {
        labels: ["Siječanj", "Veljača", "Ožujak", "Travanj", "Svibanj", "Lipanj", "Srpanj", "Kolovoz", "Rujan", "Listopad", "Studeni", "Prosinac"],
        datasets: [
            {
                label: "Projekti",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                data: jsonData
            }
        ]
    };

    var options = {
        //responsive: true,
        bezierCurve : false
    };

    new Chart(ctx).Line(data, options);
});