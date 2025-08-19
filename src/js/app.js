document.addEventListener('DOMContentLoaded', () => {eventListeners(); /*darkmode();*/});

function eventListeners(){
    const mobile_menu = document.querySelector(".mobile-menu").addEventListener('click', navegacioResponsive);
}

function navegacioResponsive(){
    const navegacion = document.querySelector('.navegacion');
    
    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
}

/*function darkmode(){
    const preferenceColor = window.matchMedia('(prefers-color-scheme: dark)');
    console.log(preferenceColor);

    preferenceColor.addEventListener('change', event => {
        console.log(event);
        event.matches ? document.body.classList.add('dark-mode') : document.body.classList.remove('dark-mode');
    });

    if(preferenceColor.matches){
        document.body.classList.add('dark-mode');
    }else{
        document.body.classList.remove('dark-mode');
    }
    const botondarmode = document.querySelector('.dark-mode-botton');
    botondarmode.addEventListener('click', () => document.body.classList.toggle('dark-mode'));
}*/