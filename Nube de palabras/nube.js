$(document).ready(function(){



var words = [{"text": "Ajax", "size": 2}, 
             {"text": "Android", "size": 3},
             {"text": "Applets/Swing", "size": 2},
             {"text": "ASP/.NET", "size": 4},
             {"text": "BBDD", "size": 3},
             {"text": "Big Data", "size": 6},
             {"text": "BPM", "size": 3},
             {"text": "C/C++", "size": 1},
             {"text": "CRM", "size": 1},
             {"text": "Cultura de Empresa/Efectividad personal", "size": 1},
             {"text": "DCOM / ActiveX", "size": 1},
             {"text": "Diseño Gráfico", "size": 1},
             {"text": "Dispositivos móviles", "size": 1},
             {"text": "EJBs/RMI  ESB", "size": 3},
             {"text": "Gestión Contenidos", "size": 4},
             {"text": "Herramientas", "size": 1},
             {"text": "Hibernate", "size": 5},
             {"text": "HTML5", "size": 4},
             
];


var fillColor = d3.scale.category20c();
var fontSize = d3.scale.log().range([15, 100]);
 
function loaded() {
      d3.layout.cloud()
            .size(size)
            .words(words)
            .font("Impact")
            .fontSize(function(d) { return fontSize(+d.size); })
            .rotate(function() { return ~~(Math.random() * 5) * 30 - 60; })
            .on("end", draw)
            .start();
}
 
function draw(words) {
      wordcloud = d3.select("body")
            .append("svg")
            .attr("width", size[0])
            .attr("height", size[1])
            .append("g")
            .attr("transform", "translate(" + (size[0]/2) + "," + (size[1]/2) + ")");
      
      wordcloud.selectAll("text")
            .data(words)
            .enter().append("text")
            .style("font-size", function(d) { return d.size + "px"; })
            .style("fill", function(d) { return fillColor(d.text.toLowerCase()); })
            .attr("text-anchor", "middle")
            .attr("transform", function(d) { return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")"; })
            .text(function(d) { return d.text; });
}

 });