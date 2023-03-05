window.onload = function(){
    let formulario = document.getElementById('cadastro')
    formulario.addEventListener('submit',verificaForm);
    formulario.cpf.addEventListener('keypress',aplicaMaskaraCPF);
    formulario.telefone.addEventListener('keypress',aplicaMaskaraTelefone)
}

function verificaForm(event){
    //////VERIFICA SENHA
    let senha = document.getElementById('senha').value
    let c_senha = document.getElementById('c_senha').value
    if(senha === c_senha){
        console.log('senhas conferem')
    }
    else{
        alert('Campos de senhas estão incompatíveis')
        event.preventDefault()
        return
    }
    if(senha.length < 6){
        alert('Senha pequena. Digite uma senha com pelo menos seis digitos')
        event.preventDefault()
        return
    }

    //VERIFICA CPF
    let cpf = document.getElementById('cpf');
    if(cpf.value.length <14){
        alert('CPF invalido')
        event.preventDefault();
        return
    }

    let cont = 0;
    for(let i = 0; i<cpf.value.length;i++){
        if(cpf.value[i] === '.')
            cont++;
    }
    
    if(cont !== 2){
        alert('CPF invalido')
        event.preventDefault();
        return
    }

    cont = 0;
    for(let i = 0; i<cpf.value.length;i++){
        if(cpf.value[i] === '-')
            cont++;
    }
    if(cont !== 1){
        alert('CPF invalido')
        event.preventDefault();
        return
    }
        
}

function aplicaMaskaraCPF(event){
    let cpf = document.getElementById('cpf')
    let tecla = event.keyCode
    if(tecla<48 || tecla>57 || cpf.value.length >=14){
        event.preventDefault()
    }
    if(cpf.value.length==3 || cpf.value.length==7){
        cpf.value += '.'
    }
    if(cpf.value.length == 11)
        cpf.value += '-'
}

function aplicaMaskaraTelefone(event){
    
    let telefone = document.getElementById('telefone')
    let tecla = event.keyCode
    if(tecla<48 || tecla>57 || telefone.value.length >=13){
        event.preventDefault()
    }
    if(telefone.value.length === 8)
        telefone.value += '-'
    if(telefone.value.length === 2)
        telefone.value += ')'
    if(telefone.value.length === 12)
        telefone.value = '('+telefone.value
}
