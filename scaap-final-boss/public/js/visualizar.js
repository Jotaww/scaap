var selectPessoa = document.getElementById('pessoa')
var pessoaJuridica = document.getElementById('pessoaJuridica')

if(selectPessoa.value == 'Física') {
  nomeArtisticoLabel.innerHTML = 'Nome artístico'
  dataNascimentoLabel.innerHTML = 'Data de nascimento'
  pessoaJuridica.style.display = 'none'
} else {
  nomeArtisticoLabel.innerHTML = 'Nome fantasia'
  dataNascimentoLabel.innerHTML = 'Data de fundação'
}

var tbodyCultural = document.getElementById('tbodyCultural')
var tbodyEsportiva = document.getElementById('tbodyEsportiva')

if(tbodyCultural.innerText == '') {
  tabelaCultural.style.display = 'none'
}
if(tbodyEsportiva.innerText == '') {
  tabelaEsportiva.style.display = 'none'
}