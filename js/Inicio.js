/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
  /*Crear Torneos------------------------------------------------------------*/
    $("#crearTorneoForm .botonRegistrar").click(function(){
        if($("#username").value!=null&&$("#nombreTorneo").value!=null&&$("#fechaInicio").value!=null&&$("#fechaFin").value!=null&&
           $("#estado").value!=null&&$("#lugar").value!=null&&$("#premioPrimero").value!=null&&$("#premioSegundo").value!=null&&
           $("#premioTercero").value!=null){
            alert("Se ha registrado exitosamente el Torneo.");
        }else
            alert("Faltan llenar campos para poder Crear un Torneo");
    });
    
    $(".parametro").click(function(){this.style.backgroundColor="#ffa";this.style.color="#000";});
    
  /*Ver Torneos------------------------------------------------------------*/  
    $(".aVerDetalles").click(function(){
        $("#anchorVerD").trigger('click');
    });
    $(".buttonModificar").click(function(){
        $("#aModtorneo").trigger('click');
    });
    $(".buttonEliminar").click(function(){
        alert("Se ha eliminado el Torneo.");
    });
    
    $("#modtorneo .botonModificar").click(function(){
        alert("Se ha modificado exitosamente el Torneo.");
    });
    $("#modtorneo .botonCancelar").click(function(){
        
    });
    
    $("#torneosPartida").change(function(){
                       
    });
    
    
    /*Modificar Resultado--------------------------------------------------------*/
    $("#rresultado .botonRegistrar").click(function(){
        alert("Se ha registrado exitosamente el Replay de la Partida.");
    });
    $("#modResultado").hide();
    $("#mresultadoTabla").show();
    $("#mresultadoTabla .buttonModificar").click(function(){
        $("#modResultado").show();
        $("#mresultadoTabla").hide();
    });
    $("#modResultado .botonModificar").click(function(){
        alert("Se ha modificado exitosamente el Replay de la Partida.");
    });
    $("#modResultado .botonCancelar").click(function(){
        $("#modResultado").hide();
        $("#mresultadoTabla").show();
    });
    /*Registrar Resultado---------------------------------------------------------*/
    /*Registrar horarios----------------------------------------------------------*/
    /*Registrar Replays----------------------------------------------------------*/
    /*Modificar Replay----------------------------------------------------------*/
    $("#rreplay .botonRegistrar").click(function(){
        alert("Se ha registrado exitosamente el Replay de la Partida.");
    });
    $("#modReplay").hide();
    $("#modReplayTable").show();
    $("#modReplayTable .buttonModificar").click(function(){
        $("#modReplay").show();
        $("#modReplayTable").hide();
    });
    $("#modReplay .botonModificar").click(function(){
        alert("Se ha modificado exitosamente el Replay de la Partida.");
    });
    $("#modReplay .botonCancelar").click(function(){
        $("#modReplay").hide();
        $("#modReplayTable").show();
    });
    /*Modificar Horario----------------------------------------------------------*/
    $("#rhorario .botonRegistrar").click(function(){
        alert("Se ha registrado exitosamente el Horario de la Partida.");
    });
    $("#modHorario").hide();
    $("#modHorarioTable").show();
    $("#modHorarioTable .buttonModificar").click(function(){
        $("#modHorario").show();
        $("#modHorarioTable").hide();
    });
    $("#modHorario .botonModificar").click(function(){
        alert("Se ha modificado exitosamente el Horario de la Partida.");
    });
    $("#modHorario .botonCancelar").click(function(){
        $("#modHorario").hide();
        $("#modHorarioTable").show();
    });
    /*user mode----------------------------------------------------------*/
    
    /*Noticias----------------------------------------------------------*/
    
    
    
});


