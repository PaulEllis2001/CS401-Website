$(document).ready(function() {
   var limit = 10000;
   var y = 100;
   var data = [];
   var dataSeries = {type: "line"};
   var dataPoints = [];

   for(var i = 0; i < limit; i+=1){
    y += Math.round(Math.random() * 10 - 5);
      dataPoints.push({ x: i, y: y});
   }
   dataSeries.dataPoints = dataPoints;
   data.push(dataSeries);

   var options = {
        zoomEnables: true,
      animationEnabled: true,
      title: {
         text: "try zooming and panning"
      },
      data: data
   }
   $("#chartContainer").CanvasJSChart(options);

    $(".buy").click(function() {
        alert("BUY");
    });
   $(".sell").click(function() {
        alert("SELL");
   });
});
