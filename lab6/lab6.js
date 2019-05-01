var images =["images/medium/5855774224.jpg","images/medium/5856697109.jpg","images/medium/6119130918.jpg","images/medium/8711645510.jpg","images/medium/9504449928.jpg"];
var title=["Battle","Luneburg","Bermuda","Athens","Florence"];
function enlarge(n){
    fig=document.getElementById("figcaption");
    var big=document.getElementById("big");
    big.src=images[n];
    big.title=title[n];
    fig.innerHTML=title[n];
}
function enter() {
    fig=document.getElementById("figcaption");
    fig.style="-webkit-animation: fadein 1s ease-out forwards;"
}
function leave() {
    fig.style="-webkit-animation: fadeout 1s ease-out forwards;";
}