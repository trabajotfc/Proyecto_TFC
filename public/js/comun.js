  
  //desactiva el enter en todos los input
  document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('input[type=text]').forEach( node => node.addEventListener('keypress', e => {
                if(e.keyCode == 13) {
                e.preventDefault();
                }
            }))
        });
        
        
// // Si pulsamos tecla en un Input
// $("input").keydown(function (e){
//   // Capturamos qué telca ha sido
//   var keyCode= e.which;
//   // Si la tecla es el Intro/Enter
//   if (keyCode == 13){
//     // Evitamos que se ejecute eventos
//     event.preventDefault();
//     // Devolvemos falso
//     return false;
//   }
// });