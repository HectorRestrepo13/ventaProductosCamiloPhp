let selecioneUsuario = document.getElementById("selecioneUsuario");
let idUsuario = document.getElementById("idUsuario");

//esta es la funcion para cuando seleciona un usuario se ponga ahi
const obtenerValor = (nombre, id) => {
  selecioneUsuario.innerHTML = nombre;
  idUsuario.value = id;
};
