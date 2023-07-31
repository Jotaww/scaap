var addSegCul = document.getElementById('addSegCul')
footerCultural.style.display = 'none'

addSegCul.addEventListener('click', function() {
  if(footerCultural.style.display == 'none'){
    footerCultural.style.display = 'block'
  }else {
    footerCultural.style.display = 'none'
  }
})

var addSegEsp = document.getElementById('addSegEsp')
footerEsportivo.style.display = 'none'

addSegEsp.addEventListener('click', function() {
  if(footerEsportivo.style.display == 'none'){
    footerEsportivo.style.display = 'block'
  }else {
    footerEsportivo.style.display = 'none'
  }
})

var addRg = document.getElementById('addRg')
footerRgCpf.style.display = 'none'

addRg.addEventListener('click', function() {
  if(footerRgCpf.style.display == 'none'){
    footerRgCpf.style.display = 'block'
  }else {
    footerRgCpf.style.display = 'none'
  }
})

var addCompResidencia = document.getElementById('addCompResidencia')
footerCompResidencia.style.display = 'none'

addCompResidencia.addEventListener('click', function() {
  if(footerCompResidencia.style.display == 'none'){
    footerCompResidencia.style.display = 'block'
  }else {
    footerCompResidencia.style.display = 'none'
  }
})

var addCompAtividade = document.getElementById('addCompAtividade')
footerCompAtividade.style.display = 'none'

addCompAtividade.addEventListener('click', function() {
  if(footerCompAtividade.style.display == 'none'){
    footerCompAtividade.style.display = 'block'
  }else {
    footerCompAtividade.style.display = 'none'
  }
})

var selectPessoa = document.getElementById('pessoa')

if(selectPessoa.value == 'Física') {
  nomeArtisticoLabel.innerHTML = 'Nome artístico'
  dataNascimentoLabel.innerHTML = 'Data de nascimento'
  nomeMaeLabel.innerHTML = 'Nome da mãe'
  pisLabel.innerHTML = 'Pis / Pasep / Nit'
} else {
  nomeArtisticoLabel.innerHTML = 'Nome fantasia'
  dataNascimentoLabel.innerHTML = 'Data de fundação'
  nomeMaeLabel.innerHTML = 'Razão social'
  pisLabel.innerHTML = 'CNPJ'
}

selectPessoa.addEventListener('change', function() {

  if(selectPessoa.value == 'Física') {
    nomeArtisticoLabel.innerHTML = 'Nome artístico'
    dataNascimentoLabel.innerHTML = 'Data de nascimento'
    nomeMaeLabel.innerHTML = 'Nome da mãe'
    pisLabel.innerHTML = 'Pis / Pasep / Nit'
  } else {
    nomeArtisticoLabel.innerHTML = 'Nome fantasia'
    dataNascimentoLabel.innerHTML = 'Data de fundação'
    nomeMaeLabel.innerHTML = 'Razão social'
    pisLabel.innerHTML = 'CNPJ'
  }

})

const campos = document.querySelectorAll('.required');
const spans = document.querySelectorAll('.span-required');
const form = document.getElementById('form');
const emailRegex = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;

function setError(index) {
  spans[index].style.display = 'block';
}

function removeError(index) {
  spans[index].style.display = 'none';
}

form.addEventListener('submit', (event) => {

  for (let i = 0; i < campos.length; i++) {
    if(campos[i].value == '') {
      setError(i)
      event.preventDefault();
    }else {
      removeError(i)
    }
  }

  if(!emailRegex.test(campos[8].value)) {
    window.scrollTo(0, 0);
    event.preventDefault();
    setError(8);
  } else{
    removeError(8)
  }

  if(campos[11].value == '') {
    window.scrollTo(0, 0);
    event.preventDefault();
    cepValidate()
  }

})

function clearError() {
  for (let i = 0; i < campos.length; i++) {
    if(campos[i].value != '') {
      removeError(i)
    }
  }
}

function isValidCPF() {
  var cpf = document.getElementById("cpf").value

  if (typeof cpf !== 'string') return false

  cpf = cpf.replace(/[^\d]+/g, '')
  
  if (cpf.length !== 11 || !!cpf.match(/(\d)\1{10}/)) return false
  
  cpf = cpf.split('')
  
  const validator = cpf
      .filter((digit, index, array) => index >= array.length - 2 && digit)
      .map( el => +el )
      
  const toValidate = pop => cpf
      .filter((digit, index, array) => index < array.length - pop && digit)
      .map(el => +el)
  
  const rest = (count, pop) => (toValidate(pop)
      .reduce((soma, el, i) => soma + el * (count - i), 0) * 10) 
      % 11 
      % 10
      
  return !(rest(10,2) !== validator[0] || rest(11,1) !== validator[1])
}

function validarcpf() {
  if ( isValidCPF() ) {
      removeError(6)
  } else {
      setError(6);
  }
}

function emailValidate(){
  if(!emailRegex.test(campos[8].value)) {
      setError(8);
  } else {
      removeError(8)
  }
}

function buscaCep() {
  let cep = document.getElementById('cep').value

  if(cep !== '') {
      let url = "https://brasilapi.com.br/api/cep/v2/" + cep

      let req = new XMLHttpRequest();
      req.open("GET", url)
      req.send()

      req.onload = function() {
          if(req.status === 200) {
            removeError(12)
            let endereco = JSON.parse(req.response)
            document.getElementById("rua").value = endereco.street
            document.getElementById("bairro").value = endereco.neighborhood
            document.getElementById("cidade").value = endereco.city
        }
        else if(req.status === 404) {
          setError(12);
        } else {
          setError(12);
        }
      }
  }
}

window.onload = function() {
  let cep = document.getElementById('cep')
  cep.addEventListener("blur", buscaCep)
}

function cepValidate(){
  if(campos[12].value == '') {
      setError(12);
  } else {
      removeError(12)
  }
}

const handlePhone = (event) => {
  let input = event.target
  input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
if (!value) return ""
value = value.replace(/\D/g,'')
value = value.replace(/(\d{2})(\d)/,"($1) $2")
value = value.replace(/(\d)(\d{4})$/,"$1-$2")
return value
}
