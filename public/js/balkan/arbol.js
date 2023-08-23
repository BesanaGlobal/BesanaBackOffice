OrgChart.LAZY_LOADING_FACTOR = 1000
OrgChart.TEXT_THRESHOLD = 1000;
OrgChart.IMAGES_THRESHOLD = 1000;
OrgChart.LINKS_THRESHOLD = 1000;
OrgChart.BUTTONS_THRESHOLD = 200;
OrgChart.ANIM_THRESHOLD = 200;;

const partners = document.getElementById("tree").dataset.tree;
var dat =JSON.parse(partners);


var datos=[];

var nodeFather = dat.shift();
       
datos.push({
 
    id:`${nodeFather.idFhater}`,
    photo  : "img/logonew.png",
});

dat.forEach(element => {
        let id = element.idSon;
        
        let pid = element.idFhater;
    let elementonew={
        
        id:`${id}`,
        pid:`${pid}`,
       
        photo  : "img/logonew.png",
    };
    datos.push(elementonew);
});

datos.pop();
console.log(datos)

//inicia
var nodes = [];

nodes.push({
    id: "1_1", photo: "https://cdn.balkan.app/shared/1.jpg"
});

var imgIndex = 2;
for (var i = 0; i < 1000; i++) {
    nodes.push({
        id: "2_" + i, pid: "1_1", photo: "https://cdn.balkan.app/shared/" + imgIndex + ".jpg"
    });

    for (var j = 3; j < 7; j++) {
        nodes.push({
            id: j + "_" + i, pid: "2_" + i, photo: "https://cdn.balkan.app/shared/" + imgIndex + ".jpg"
        });

        imgIndex++;
        if (imgIndex > 15) {
            imgIndex = 2;
        }
    }
}


var chart = new OrgChart(document.getElementById("tree"), {
    template: "ana",
    lazyLoading: true,
    showXScroll: OrgChart.scroll.visible,
    mouseScrool: OrgChart.action.xScroll,
    layout: OrgChart.mixed,
    scaleInitial: OrgChart.match.height,
    nodeBinding: {
        field_0: "id",
       
        img_0: "photo"
    },
    nodes: datos
});

console.log(chart);