$(document).ready(function() {

   var limit = 10000;
   var y = 100;
   var data = [];
   var dataSeries = {type: "line"};
   var dataPoints = [];
   //get the coin_name query string of the page
   //read in files/'coin_name'info.json
   //use the json file to populate the graph instead of random values.
   
   function parseData(inputJson){
    let obj = inputJson;
      let begin = obj[0]["change_time"];
      let end = obj[obj.length-1]["change_time"];


      var data = [];
      var dataSeries = {type: "line"};
      var dataPoints = [];



      const day = 360000*24;
     
      for( var i = 0; i < obj.length; i++){
        let x = (Date.parse(obj[i]["change_time"]) - Date.parse(begin))/(3600000*24);
        let y = obj[i]["coin_new_value"];
        dataPoints.push({x: x, y: y});
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

   }

   let test = new Proxy(new URLSearchParams(window.location.search), {get:(searchParams, prop) => searchParams.get(prop),});
   let coinName = test.coin_name;
   let fileName = coinName + "_history.json";
   let path = "./files/" + fileName;
   
    let inputData = null

   if(fileName != null){
   fetch(path)
   .then((response) => response.json())
   .then((json) => inputData = parseData(json));
    }

});
