var divSegCultural = document.getElementById('divSegCultural')
var divSegEsportivo = document.getElementById('divSegEsportivo')
var segmentoCultural = document.getElementById('segmentoCultural')
var segmentoEsportivo = document.getElementById('segmentoEsportivo')
var tipoSegmento = document.getElementById('tipoSegmento')

if(tipoSegmento.value == 1) {
  segmentoCultural.disabled = false;
  divSegCultural.style.display = 'block'
  divSegEsportivo.style.display = 'none'
} 
else if(tipoSegmento.value == 2) {
  segmentoEsportivo.disabled = false;
  divSegEsportivo.style.display = 'block'
  divSegCultural.style.display = 'none'
}

tipoSegmento.onchange = function(){
  if(tipoSegmento.value == '') {
    segmentoCultural.disabled = true;
    segmentoEsportivo.disabled = true;
  }
  else if(tipoSegmento.value == 1) {
    segmentoCultural.disabled = false;
    segmentoEsportivo.disabled = true;
    divSegCultural.style.display = 'block'
    divSegEsportivo.style.display = 'none'
  } 
  else if(tipoSegmento.value == 2) {
    segmentoEsportivo.disabled = false;
    segmentoCultural.disabled = true;
    divSegEsportivo.style.display = 'block'
    divSegCultural.style.display = 'none'
  }

}