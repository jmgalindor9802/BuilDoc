DELIMITER //
/*---GESTION DE ARCHIVOS---*/

/*Listar todos los proyectos por nombre de un municipio especifico, 
si el argumento llega a ser nulo listara todos los proyectos 
registrados con su respectivo municipio.*/
/*call Listar_los_usuarios_asignados_a_los_proyectos_por_municipio('Cali');
call Listar_los_usuarios_asignados_a_los_proyectos_por_municipio(NULL);*/
create procedure Listar_los_usuarios_asignados_a_los_proyectos_por_municipio(
	in municipio varchar (50))
    BEGIN
	if municipio is not null then
        select
        ga_proyecto.pronombre as "Nombre del Proyecto",
		usuario.usunombre as "Nombre del Usuario", 
		usuario.usuapellido as "Apellido del Usuario"
        from ga_proyecto
        inner join usuarios_proyectos on ga_proyecto.pk_id_proyecto = usuarios_proyectos.fk_id_proyecto
        inner join usuario on usuarios_proyectos.fk_id_usuario = usuario.pk_id_usuario
        where ga_proyecto.promunicipio = municipio;
    else
        select ga_proyecto.proMunicipio as "Municipio", 
        ga_proyecto.pronombre as "Nombre del Proyecto",
		usuario.usunombre as "Nombre del Usuario", 
		usuario.usuapellido as "Apellido del Usuario"
        from ga_proyecto
        inner join usuarios_proyectos on ga_proyecto.pk_id_proyecto = usuarios_proyectos.fk_id_proyecto
        inner join usuario on usuarios_proyectos.fk_id_usuario = usuario.pk_id_usuario
        order by ga_proyecto.proMunicipio;
    end if;
	COMMIT;
END//

/*Listar todas las carpetas con sus correspondientes archivos por nombre 
de un proyecto en especifico, si alguna carpeta esta vacia se mostrara de todas 
formas el nombre de aquella.*/
/*call Listar_archivos_y_carpetas_por_nombre_proyecto('Puente Peatonal');*/
create procedure Listar_archivos_y_carpetas_por_nombre_proyecto(
	in proyecto_nombre VARCHAR(100))
	BEGIN
    select ga_proyecto.proNombre as "Nombre del Proyecto", ga_carpeta.carnombre as "Nombre de la Carpeta", 
    ga_archivo.arcnombre_original as "Nombre del Archivo"
    from ga_carpeta
	inner join ga_proyecto on ga_proyecto.pk_id_proyecto = ga_carpeta.fk_id_proyecto
    left join ga_archivo on ga_carpeta.pk_id_carpeta = ga_archivo.fk_id_carpeta
    where ga_proyecto.proNombre  LIKE CONCAT('%', proyecto_nombre, '%');
    COMMIT;
END //

/*Listar las versiones por id de un archivo en especifico, con el autor 
y la fecha de creacion de la version.*/
/*call Listar_versiones_archivo(4);*/
CREATE PROCEDURE Listar_versiones_archivo(IN archivo_id BIGINT)
BEGIN
	SET @numero_version := 0;
    SELECT 
	   (@numero_version := @numero_version + 1) AS "Numero de Version",
	   gv.verArchivoOriginal as "ID del Archivo Original", 
	   gv.verArchivoVersion as "ID del Archivo Version",
       ga.arcNombre_Original as "Nombre del Archivo",
       ga.arcFecha_creacion as "Fecha de Creacion",
       u.usuNombre as "Nombre del Autor",
       u.usuApellido as "Apellido del Autor"
       from ga_archivo ga
       inner join ga_archivoversion gv on gv.verArchivoVersion = ga.pk_id_archivo
       inner join usuario u on ga.fk_id_usuario = u.pk_id_usuario
	   WHERE gv.verArchivoOriginal = archivo_id
	   ORDER BY
	   ga.arcFecha_creacion;
       COMMIT;
END //

/*---GESTION DE TAREAS---*/
/*Listar tareas por fase*/
CREATE PROCEDURE ListarTareasPorFase(
    IN fase_id INT
)
BEGIN
    SELECT
        t.pk_id_tarea AS "ID de Tarea",
        t.tarNombre AS "Nombre de Tarea"
    FROM
        gt_tarea t
        JOIN gt_fase f ON t.fk_id_fase = f.pk_id_fase
     
     
    WHERE
        f.pk_id_fase = fase_id;
      
    COMMIT;
END //

/*Listar tareas por fase y proyecto*/
CREATE PROCEDURE ListarTareasPorFaseYProyecto(
    IN fase_id INT,
    IN proyecto_id INT
)
BEGIN
    SELECT
        t.pk_id_tarea AS "ID de Tarea",
        t.tarNombre AS "Nombre de Tarea"
    FROM
        gt_tarea t
        JOIN gt_fase f ON t.fk_id_fase = f.pk_id_fase
        JOIN ga_proyecto p ON f.fk_id_proyecto = p.pk_id_proyecto
        JOIN usuarios_gt_tareas ut ON t.pk_id_tarea = ut.fk_id_tarea
     
    WHERE
        f.pk_id_fase = fase_id
        AND p.pk_id_proyecto = proyecto_id;
    COMMIT;
END //

/* Listar las tareas pendientes por proyecto para los proximos 7 dias tomando como referencia la fecha actual */
/* call listar_tareas_pendientes_proximos_7_dias_por_proyecto(4); */
CREATE PROCEDURE listar_tareas_pendientes_proximos_7_dias_por_proyecto (
    IN proyecto BIGINT
)
BEGIN
    IF proyecto IS NULL THEN
        SELECT
            p.proNombre AS Proyecto,
            f.fasNombre AS Fase,
            t.tarNombre AS Tarea,
            t.tarFecha_limite AS Fecha_Limite,
            CONCAT(u.usuNombre, " ", u.usuApellido) AS Responsable,
            TIMESTAMPDIFF(HOUR, NOW(), t.tarFecha_limite) AS Tiempo_Restante
        FROM
            gt_tarea t
            JOIN gt_fase f ON t.fk_id_fase = f.pk_id_fase
            JOIN ga_proyecto p ON f.fk_id_proyecto = p.pk_id_proyecto
            JOIN usuarios_gt_tareas ut ON t.pk_id_tarea = ut.fk_id_tarea
            JOIN usuario u ON u.pk_id_usuario = ut.fk_id_usuario
        WHERE
            t.tarEstado = 'PENDIENTE'
            AND t.tarFecha_limite BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
        ORDER BY
            p.proNombre, f.fasNombre, t.tarFecha_limite;
    ELSE
        SELECT
            p.proNombre AS Proyecto,
            f.fasNombre AS Fase,
            t.tarNombre AS Tarea,
            t.tarFecha_limite AS Fecha_Limite,
            CONCAT(u.usuNombre, " ", u.usuApellido) AS Responsable,
            TIMESTAMPDIFF(HOUR, NOW(), t.tarFecha_limite) AS Tiempo_Restante
        FROM
            gt_tarea t
            JOIN usuarios_gt_tareas ut ON ut.fk_id_tarea = t.pk_id_tarea
            JOIN usuario u ON ut.fk_id_usuario = u.pk_id_usuario
            JOIN gt_fase f ON t.fk_id_fase = f.pk_id_fase
            JOIN ga_proyecto p ON f.fk_id_proyecto = p.pk_id_proyecto
        WHERE
            t.tarEstado = 'PENDIENTE'
            AND t.tarFecha_limite BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 7 DAY)
            AND p.pk_id_proyecto = proyecto
        ORDER BY
            p.proNombre, f.fasNombre, t.tarFecha_limite;
    END IF;
    COMMIT;
END//


/* Listar las fases que hay en un proyecto*/
CREATE PROCEDURE listar_fases_por_proyecto (
    IN proyecto BIGINT
)
BEGIN
        SELECT
            f.fasNombre AS Fase,
            f.pk_id_fase AS id_fase
        FROM
            gt_fase f
        WHERE
          f.fk_id_proyecto = proyecto
        ORDER BY
       f.fasNombre;

END // 

/* Listar las tareas por id del usuario y por el nombre del proyecto*/
/* CALL listar_tareas_por_usuario_por_proyecto (1011234567,"planta" ) */
CREATE PROCEDURE listar_tareas_por_usuario_por_proyecto(
    IN usuario BIGINT,
    IN nombre_proyecto VARCHAR(100)
)
BEGIN
    SELECT 
        p.proNombre AS Proyecto,
        f.fasNombre AS Fase,
        t.tarNombre AS Tarea,
        t.tarFecha_limite AS Fecha_Limite
    FROM 
        usuarios_gt_tareas ut
		JOIN gt_tarea t ON ut.fk_id_tarea=t.pk_id_tarea
        JOIN gt_fase f ON t.fk_id_fase = f.pk_id_fase
        JOIN ga_proyecto p ON f.fk_id_proyecto = p.pk_id_proyecto
       
    WHERE 
        ut.fk_id_usuario = usuario
        AND p.proNombre LIKE CONCAT('%', nombre_proyecto, '%')
    ORDER BY 
        p.proNombre;
	COMMIT;
END//

/* Este procedimiento lista las tareas vencidas, es decir, aquellas con estado 'PENDIENTE' cuya fecha límite 
es anterior a la fecha actual, tomando como referencia el identificador del proyecto. 
Además, se incluye la cantidad de días de retraso respecto a la fecha límite original*/
/* call listar_tareas_vencidas_pendientes_por_proyecto(23); */ 
CREATE PROCEDURE listar_tareas_vencidas_pendientes_por_proyecto(
    IN proyecto BIGINT
)
BEGIN 
    SELECT 
        f.fasNombre AS "Fase",
        t.tarNombre AS Tarea,
        t.tarFecha_limite AS "Fecha Limite",
        CONCAT(u.usuNombre, ' ', u.usuApellido) AS "Responsable",
        DATEDIFF(CURDATE(), t.tarFecha_limite) AS "Dias de Retraso"
    FROM 
        gt_tarea t
        JOIN usuarios_gt_tareas ut ON ut.fk_id_tarea = t.pk_id_tarea
        JOIN usuario u ON ut.fk_id_usuario = u.pk_id_usuario
        JOIN gt_fase f ON t.fk_id_fase = f.pk_id_fase
        JOIN ga_proyecto p ON f.fk_id_proyecto = p.pk_id_proyecto
    WHERE 
        t.tarEstado = 'PENDIENTE'
        AND t.tarFecha_limite < CURDATE()
        AND p.pk_id_proyecto = proyecto; 
END//


/*---GESTION DE INCIDENTES E INSPECCIONES---*/

/*Listar las inspecciones agendadas de un proyecto por un mes en especifico
  CALL ConsultarInspeccionesPorProyectoYMes('Proyecto de Puente Peatonal', 9);*/
CREATE PROCEDURE ConsultarInspeccionesPorProyectoYMes(
    IN proyecto_nombre VARCHAR(255),
    IN mes INT
)
BEGIN
    DECLARE proyecto_id BIGINT;
    DECLARE aviso VARCHAR(200);
    SET aviso = "no se encontro un proyecto con el nombre indicado";

    SELECT pk_id_proyecto INTO proyecto_id
    FROM ga_proyecto
    WHERE proNombre LIKE CONCAT('%', proyecto_nombre, '%');

    IF proyecto_id IS NULL THEN
        select aviso;
    END IF;

    SELECT insNombre, insDescripcion, insEstado, insFecha_inicial,
           IFNULL(insPeriodicidad, '') AS insPeriodicidad,
           IFNULL(insFecha_final, '') AS insFecha_final
    FROM gii_inspeccion
    WHERE fk_id_proyecto = proyecto_id
    AND MONTH(insFecha_inicial) = mes;
    COMMIT;
END//


/*Listar los incidentes e involucrados relacionados con un proyecto especificado.
  Y los proyectos donde no tengan involucrados no se repite
  CALL ConsultarIncidentesYInvolucradosConProyecto('Proyecto de Puente Peatonal');*/
CREATE PROCEDURE ConsultarIncidentesYInvolucradosConProyecto(
    IN proyecto_nombre VARCHAR(255)
)
BEGIN
    DECLARE proyecto_id BIGINT;
    DECLARE aviso VARCHAR(200);
    SET aviso = "no se encontro un proyecto con el nombre indicado";

    SELECT pk_id_proyecto INTO proyecto_id
    FROM ga_proyecto
    WHERE proNombre LIKE CONCAT('%', proyecto_nombre, '%');

    IF proyecto_id IS NULL THEN
        SELECT aviso;
    ELSE
        SELECT p.proNombre AS "Proyecto", i.incNombre AS "Incidente",
               CONCAT(iv.invNumDocumento, ' - ', iv.invNombre, ' ', iv.invApellido) AS "Involucrado", iv.invJustificacion AS "Justificacion", i.incFecha AS "Fecha y hora del incidente"
        FROM gii_incidente i
        INNER JOIN gii_involucrado iv ON i.pk_id_incidente = iv.fk_id_incidente
        INNER JOIN ga_proyecto p ON i.fk_id_proyecto = p.pk_id_proyecto
        WHERE i.fk_id_proyecto = proyecto_id;
    END IF;
    COMMIT;
END //



/*Listar todos los seguimientos de un proyecto y incidente en especifico
  CALL ConsultarSeguimientosDeProyecto('Proyecto de Puente Peatonal','Desperfecto en los pisos');*/
CREATE PROCEDURE ConsultarSeguimientosDeProyecto(
    IN proyecto_nombre VARCHAR(255),
    IN incidente_nombre VARCHAR(255)
)
BEGIN

    DECLARE proyecto_id BIGINT;
    DECLARE incidente_id BIGINT;

    -- Obtener el ID del proyecto
    SELECT pk_id_proyecto INTO proyecto_id
    FROM ga_proyecto
    WHERE proNombre LIKE CONCAT('%', proyecto_nombre, '%');

    -- Obtener el ID del incidente
    SELECT pk_id_incidente INTO incidente_id
    FROM gii_incidente
    WHERE incNombre LIKE CONCAT('%', incidente_nombre, '%');

    -- Filtrar los resultados de la consulta
    SELECT i.incNombre AS "Incidente", seg.actDescripcion AS "Descripcion del seguimiento", seg.actFecha AS "Fecha y hora de actualizacion", seg.actSugerencia AS "Sugerencia en el seguimiento"
    FROM gii_seguimiento seg
    INNER JOIN gii_incidente i ON i.pk_id_incidente = seg.fk_id_incidente
    WHERE fk_id_proyecto = proyecto_id AND fk_id_incidente = incidente_id;
    
    COMMIT;
END//


DELIMITER ;